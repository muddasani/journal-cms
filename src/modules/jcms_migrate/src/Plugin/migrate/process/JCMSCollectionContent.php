<?php

namespace Drupal\jcms_migrate\Plugin\migrate\process;

use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\Row;

/**
 * Process the collection content values into entity reference values.
 *
 * @MigrateProcessPlugin(
 *   id = "jcms_collection_content"
 * )
 */
class JCMSCollectionContent extends AbstractJCMSContainerFactoryPlugin {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    if (!empty($value)) {
      if (!isset($this->configuration['multiple']) || $this->configuration['multiple'] === FALSE) {
        return $this->processItemValue($value['type'], $value['source'], $migrate_executable, $row, $destination_property);
      }
      else {
        $items = [];
        foreach ($value as $val) {
          $items[] = $this->processItemValue($val['type'], $val['source'], $migrate_executable, $row, $destination_property);
        }
        return $items;
      }
    }

    return NULL;
  }

  private function processItemValue($type, $source, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    switch ($type) {
      case 'interview':
        return $this->migrationDestionationIDs('jcms_interviews_db', $source, $migrate_executable, $row, $destination_property);
        break;
      case 'blog_article':
        return $this->migrationDestionationIDs('jcms_blog_articles_db', $source, $migrate_executable, $row, $destination_property);
        break;
      case 'article':
        $crud_service = \Drupal::service('jcms_notifications.article_crud_service');
        if ($nid = $crud_service->nodeExists($source)) {
          return $nid;
        }
        else {
          $node = $crud_service->createArticle(['id' => $source]);
          return $node->id();
        }
        break;
    }

    return NULL;
  }

}
