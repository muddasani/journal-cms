<?php

namespace Drupal\jcms_notifications;

use Drupal\Core\Entity\EntityTypeManager;
use Drupal\node\Entity\Node;
use Drupal\paragraphs\Entity\Paragraph;

/**
 * Class ArticleCrudService.
 *
 * @package Drupal\jcms_notifications
 */
class ArticleCrudService {

  /**
   * @var \Drupal\jcms_notifications\FetchArticleService
   */
  protected $fetchArticle;

  /**
   * @var \Drupal\Core\Entity\EntityTypeManager
   */
  protected $entityTypeManager;

  /**
   * ArticleCrudService constructor.
   *
   * @param \Drupal\jcms_notifications\FetchArticleService $fetch_article
   * @param \Drupal\Core\Entity\EntityTypeManager $entity_type_manager
   */
  public function __construct(FetchArticleService $fetch_article, EntityTypeManager $entity_type_manager) {
    $this->fetchArticle = $fetch_article;
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * Helper method to decide whether to created, update or delete a node.
   *
   * @param array $article
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   */
  public function crudArticle(array $article) {
    $node = NULL;
    if ($nid = $this->nodeExists($article['id'])) {
      if ($article['action'] == 'del') {
        $node = $this->deleteArticle($nid);
      }
      else {
        $node = $this->updateArticle($article);
      }
    }
    return $node;
  }

  /**
   * Creates a new article node.
   *
   * @param array $article
   *
   * @return \Drupal\Core\Entity\EntityInterface
   */
  public function createArticle(array $article) {
    $node = Node::create([
      'type' => 'article',
      'title' => $article['id'],
    ]);

    if (!empty($article['data'])) {
      $config = [
        'type' => 'json',
        'field_article_unpublished_json' => [
          'value' => $article['data']['unpublished'],
        ],
      ];
      if ($article['data']['published']) {
        $config['field_article_published_json'] = [
          'value' => $article['data']['published'],
        ];
      }
      $paragraph = Paragraph::create($config);
      $paragraph->save();
      $node->field_article_json = [
        [
          'target_id' => $paragraph->id(),
          'target_revision_id' => $paragraph->getRevisionId(),
        ],
      ];
    }

    $node->save();
    return $node;
  }

  /**
   * Updates an existing article node.
   *
   * @param array $article
   *
   * @return \Drupal\Core\Entity\EntityInterface|null
   */
  public function updateArticle(array $article) {
    $nid = $this->nodeExists($article['id']);
    $node = Node::load($nid);
    if ($node) {
      $pid = $node->get('field_article_json')->getValue()[0]['target_id'];
      $paragraph = Paragraph::load($pid);
      $paragraph->set('field_article_unpublished_json', $article['data']['unpublished']);
      if ($article['data']['published']) {
        $paragraph->set('field_article_published_json', $article['data']['published']);
      }
      $paragraph->setNewRevision();
      $paragraph->save();
      $node->field_article_json = [
        [
          'target_id' => $paragraph->id(),
          'target_revision_id' => $paragraph->getRevisionId(),
        ],
      ];
      $node->save();
    }
    return $node;
  }

  /**
   * Deletes an article node.
   *
   * @param $node_id
   *
   * @return mixed
   */
  public function deleteArticle(int $node_id) {
    return $this->entityTypeManager->getStorage('node')->delete([$node_id]);
  }

  /**
   * Checks if a node with the article ID already exists.
   *
   * @param string $article_id
   *
   * @return int
   *   The node ID.
   */
  public function nodeExists(string $article_id) {
    $query = \Drupal::entityQuery('node')
      ->condition('title', $article_id);
    $result = $query->execute();
    return !empty($result) ? reset($result) : 0;
  }

}