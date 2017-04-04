<?php

namespace Drupal\Tests\jcms_migrate\Unit\process;

use Drupal\jcms_migrate\Plugin\migrate\process\JCMSPressPackageContent;
use Drupal\Tests\migrate\Unit\process\MigrateProcessTestCase;

/**
 * Tests for the press package content process plugin.
 *
 * @coversDefaultClass \Drupal\jcms_migrate\Plugin\migrate\process\JCMSPressPackageContent
 * @group jcms_migrate
 */
class JCMSPressPackageContentTest extends MigrateProcessTestCase {

  /**
   * @test
   * @covers ::transform
   * @dataProvider breakupContentDataProvider
   * @group journal-cms-tests
   */
  public function testBreakupContent($content, $expected_result) {
    $plugin = new JCMSPressPackageContent([], 'jcms_split_collection_content', []);
    $breakup_content = $plugin->breakupContent($content);
    $this->assertEquals($expected_result, array_intersect_key($breakup_content, array_flip(array_keys($expected_result))));
  }

  public function breakupContentDataProvider() {
    return [
      [
        "<p><strong>Rats with restricted feeding schedules learn to eat more, helped by the &ldquo;hunger hormone&rdquo; ghrelin, according to new research from the University of Southern California.</strong></p>\n\n<p>The insights, to be published in the journal eLife, could be valuable for helping the researchers develop new effective weight-loss therapies.</p>",
        [
          'summary' => 'Rats with restricted feeding schedules learn to eat more, helped by the &ldquo;hunger hormone&rdquo; ghrelin, according to new research from the University of Southern California.',
        ],
      ],
      [
        "<div>\n  <strong>Scientists from the University of Louvain have discovered that a key element of infant brain development occurs years earlier than previously thought.</strong></div>\n<div>\n  &nbsp;</div>\n<div>\n  The way we perceive faces &mdash; using the right hemisphere of the brain &mdash; &nbsp;is unique and sets us apart from non-human primates. It was believed that this ability develops as we learn to read, but a new study published in the journal eLife shows that in babies as young as four months it is already highly evolved.</div>\n<div>",
        [
          'summary' => 'Scientists from the University of Louvain have discovered that a key element of infant brain development occurs years earlier than previously thought.',
        ],
      ],
      [
        "<div>\n<p><strong>Scientists have revealed the brain activity in animals that helps them find food and other vital resources in unfamiliar environments where there are no cues, such as lights and sounds, to guide them.</strong>&nbsp;</p>\n</div>\n\n<div>\n<p>Animals that are&nbsp;placed&nbsp;in&nbsp;such&nbsp;environments&nbsp;display spontaneous, seemingly random&nbsp;behaviors&nbsp;when foraging.&nbsp;These behaviors have been observed in many organisms,&nbsp;although&nbsp;the brain activity&nbsp;behind them has&nbsp;remained elusive due to difficulties in&nbsp;knowing&nbsp;where to look for neural signals in large vertebrate brains.&nbsp;&nbsp;</p>\n</div>\n\n<div>\n<p>Now, in a&nbsp;study to be published in the journal&nbsp;eLife, researchers&nbsp;have used whole-brain imaging in larval&nbsp;zebrafish&nbsp;to&nbsp;discover how their brain activity translates&nbsp;into spontaneous behaviors. They found that&nbsp;the&nbsp;animals’&nbsp;behavior&nbsp;in plain surroundings&nbsp;is&nbsp;not&nbsp;random&nbsp;at all, but is&nbsp;characterized by alternating left and right&nbsp;turn “states” in the brain,&nbsp;where the animals&nbsp;are more likely to perform repeated left and right turning&nbsp;maneuvers, respectively.&nbsp;&nbsp;</p>\n</div>",
        [
          'summary' => 'Scientists have revealed the brain activity in animals that helps them find food and other vital resources in unfamiliar environments where there are no cues, such as lights and sounds, to guide them.',
          'content' => "<div>\n<p></p>\n</div>\n\n<div>\n<p>Animals that are placed in such environments display spontaneous, seemingly random behaviors when foraging. These behaviors have been observed in many organisms, although the brain activity behind them has remained elusive due to difficulties in knowing where to look for neural signals in large vertebrate brains. </p>\n</div>\n\n<div>\n<p>Now, in a study to be published in the journal eLife, researchers have used whole-brain imaging in larval zebrafish to discover how their brain activity translates into spontaneous behaviors. They found that the animals’ behavior in plain surroundings is not random at all, but is characterized by alternating left and right turn “states” in the brain, where the animals are more likely to perform repeated left and right turning maneuvers, respectively. </p>\n</div>",
          'relatedContent' => NULL,
        ],
      ],
      [
        "<p><strong>The wide diversity of flu in pigs across multiple continents, mostly introduced from humans, highlights the significant potential of new swine flu strains emerging, according to a study&nbsp;published in eLife.</strong></p>\n\n<p>While swine flu viruses have long been considered a risk for human pandemics, and were the source of the 2009 pandemic H1N1 virus, attention has recently turned to the transmission of flu viruses from humans to pigs.</p>\n\n<p>&#x201C;Once in pigs, flu viruses from humans continue to evolve their surface proteins, generically referred to as antigens, resulting in a tremendous diversity of novel flu viruses that can be transmitted to other pigs and also to humans,&#x201D; explains first author Nicola Lewis from the University of Cambridge. &nbsp;</p>\n\n<p>&#x201C;These flu viruses pose a serious threat to public health because they are no longer similar enough to the current human flu strains for our immune systems to recognise them and mount an effective defence. Understanding the dynamics and consequences of this two-way transmission is important for designing effective strategies to detect and respond to new strains of flu.&#x201D;</p>\n\n<p>Humans and pigs both experience regular outbreaks of influenza A viruses, most commonly from H1 and H3 subtypes. Their genetic diversity is well characterised. However, the diversity of their antigens, which shapes their pandemic potential, is poorly understood, mainly due to lack of data.</p>\n\n<p>To help improve this understanding, Lewis and her team created the largest and most geographically comprehensive dataset of antigenic variation. They amassed and characterised antigens from nearly 600 flu viruses dating back from 1930 through to 2013 and collected from multiple continents, including Europe, the US, and Asia. They included nearly 200 viruses that had never been studied before.</p>\n\n<p>Analysis of their data reveals that the amount of antigenic diversity in swine flu viruses resembles the diversity of H1 and H3 viruses seen in humans over the last 40 years, driven by the frequent introduction of human viruses to pigs. In contrast, flu from birds has rarely contributed substantially to the diversity in pigs. However, little is currently known about the antigenic relationship between flu in birds and pigs.</p>\n\n<p>&#x2028;&#x201C;Since most of the current swine flu viruses are the result of human seasonal flu virus introductions into pigs, we anticipate at least some&nbsp;cross-protective immunity in the human population, which could potentially interfere with a re-introduction of these viruses. For example, the H1N1pdm09 viruses circulating in both humans and pigs are antigenically similar and therefore&nbsp;likely induce some immunity in both hosts,&#x201D; says Lewis.</p>\n\n<p>&#x201C;However, for the H1 1C, H3 3A, and H3 3B human seasonal lineages in pigs,&nbsp;the risk of re-introduction into the human population increases with the number of people born after the circulation of the human precursor virus, and is increased by the antigenic evolution of these viruses in pigs. Earlier introduced lineages of human H1 and H3 viruses therefore pose the greatest current risk to humans, due to the low or negligible predicted levels of cross-immunity in individuals born since the 1970s.&#x201D;</p>\n\n<p>Swine flu causes symptoms such as coughing, fever, body aches, chills, and fatigue in humans. Pigs can also experience fever and coughing (barking), along with discharge from the nose or eyes, breathing difficulties, eye redness or inflammation, and going off feed &#x2013; although some display no clinical signs at all.</p>\n\n<p>Vaccination to control flu in pigs is used extensively in the US and occasionally in other regions. Control strategies vary by region, with some countries not using any vaccinations, while others produce herd-specific vaccines for individual producers. There is no formal system for matching vaccine strains with circulating strains, however, and no validated protocols for standardisation and effective vaccine use.</p>\n\n<p>&#x201C;The significant antigenic diversity that we see in our data means it is&nbsp;highly unlikely that one vaccine strain per subtype would be effective on a global scale, or even&nbsp;in a given region,&#x201D; says co-author Colin Russell, also from the University of Cambridge.</p>\n\n<p>&#x201C;Our findings therefore have important implications for developing flu vaccines for pigs. They also emphasise the need for more focused surveillance in areas with a high pig population density, such as China, and situations where humans and pigs have close contact, in order to better assess the incidence of transmission between the animals and risk of spreading to humans.&#x201D;</p>\n\n<p>##</p>\n\n<p><strong>Reference</strong></p>\n\n<p>The paper &#x2018;The global antigenic diversity of swine influenza A viruses&#x2019; can be freely accessed online at <a href=\"http://dx.doi.org/10.7554/eLife.12217\">http://dx.doi.org/10.7554/eLife.12217</a>. Contents, including text, figures, and data, are free to reuse under a CC BY 4.0 license.</p>\n\n<p><strong>Media contacts</strong></p>\n\n<p>Craig Brierley, University of Cambridge</p>\n\n<p><a href=\"mailto:craig.brierley@admin.cam.ac.uk\">craig.brierley@admin.cam.ac.uk</a></p>\n\n<p>01223 332300</p>\n\n<p>Emily Packer, eLife</p>\n\n<p><a href=\"mailto:e.packer@elifesciences.org\">e.packer@elifesciences.org</a></p>\n\n<p>01223 855373</p>\n\n<p><strong>About eLife</strong></p>\n\n<p>eLife is a unique collaboration between the funders and practitioners of research to improve the way important research is selected, presented, and shared. eLife publishes outstanding works across the life sciences and biomedicine &#x2014; from basic biological research to applied, translational, and clinical studies. All papers are selected by active scientists in the research community. Decisions and responses are agreed by the reviewers and consolidated by the Reviewing Editor into a single, clear set of instructions for authors, removing the need for laborious cycles of revision and allowing authors to publish their findings quickly. eLife is supported by the Howard Hughes Medical Institute, the Max Planck Society, and the Wellcome Trust. Learn more at elifesciences.org.</p>\n",
        [
          'relatedContent' => [
            [
              'type' => 'article',
              'source' => '12217',
            ],
          ],
          'mediaContacts' => [
            [
              'name' => [
                'preferred' => 'Craig Brierley',
                'index' => 'Brierley, Craig',
              ],
              'emailAddresses' => [
                'craig.brierley@admin.cam.ac.uk',
              ],
              'phoneNumbers' => [
                '+441223332300',
              ],
              'affiliations' => [
                [
                  'name' => [
                    'University of Cambridge',
                  ],
                ],
              ],
            ],
          ],
        ],
      ],
      [
        "<p>A new and inexpensive technique for mass-producing the main ingredient in the most effective treatment for malaria, artemisinin, could help meet global demands for the drug, according to a study to be published in the journal eLife.&nbsp;</p>\n\n<p>Artemisinin is produced in low yields by a herb called <em>Artemisia annua</em> (<em>A. annua</em>), otherwise known as sweet wormwood. Researchers from the Max Planck Institute of Molecular Plant Physiology have now discovered a new way to produce artemisinic acid, the molecule from which artemisinin is derived, in high yields. Their method involves transferring its metabolic pathway &#x2013; the series of biochemical steps involved in its production &#x2013; from <em>A. annua</em> into tobacco, a high-biomass crop. &nbsp;</p>\n\n<p>&#x201C;Malaria is a devastating tropical disease that kills almost half a million people every year,&#x201D; says contributing author Ralph Bock, Director of the Department for Organelle Biology, Biotechnology and Molecular Ecophysiology.&nbsp;</p>\n\n<p>&#x201C;For the foreseeable future, artemisinin will be the most powerful weapon in the battle against malaria but, due to its extraction from low-yielding plants, it is currently too expensive to be widely accessible to patients in poorer countries. Producing artemisinic acid in a crop such as tobacco, which yields large amounts of leafy biomass, could provide a sustainable and inexpensive source of the drug, making it more readily available for those who need it most.&#x201D;&nbsp;</p>\n\n<p>The team has called this approach to producing more artemisinic acid COSTREL (&#x201C;combinatorial supertransformation of transplastomic recipient lines&#x201D;). The first step in their process was to transfer the genes of the artemisinic acid pathway&#x2019;s core set of enzymes into the chloroplast genome of tobacco plants, generating what are known as transplastomic plants.&nbsp;</p>\n\n<p>The team then used their best transplastomic tobacco plant line to introduce an additional set of genes into its nuclear genome, generating the COSTREL lines. These remaining genes encode factors that increase the synthesis, or generation, of the acid in ways that are still largely unknown.&nbsp;</p>\n\n<p>&#x201C;While the artemisinic acid pathway in <em>A. annua</em> is confined to the glandular hairs on the plant, leading to low yields of artemisinin, our COSTREL tobacco lines produce it in their chloroplasts and therefore the whole leaf,&#x201D; says lead author and postdoctoral researcher Paulina Fuentes.&nbsp;</p>\n\n<p>&#x201C;We generated over 600 engineered tobacco plant lines that harbour different combinations of these additional genes, and analysed them in terms of the amounts of artemisinic compounds they acquired. We could then identify those that generated unprecedented levels of 120 milligrams per kilogram of artemisinic acid in their leaves, which can be readily converted into artemisinin through simple chemical reactions.&#x201D;&nbsp;</p>\n\n<p>Although further increases in these production levels will be needed if global demand for artemisinin is to be met, the study lays the foundation for much cheaper production of this life-saving therapy in a high-biomass crop, in contrast to a single medicinal plant.&nbsp;</p>\n\n<p>It also provides a new tool for engineering many other complex pathways, with the potential to increase production of other essential therapeutic ingredients.&nbsp;</p>\n\n<p>##&nbsp;</p>\n\n<p><strong>Reference</strong>&nbsp;</p>\n\n<p>The paper &#x2018;A new synthetic biology approach allows transfer of an entire metabolic pathway from a medicinal plant to a biomass crop&#x2019; can be freely accessed online at http://dx.doi.org/10.7554/eLife.13664. Contents, including text, figures, and data, are free to reuse under a CC BY 4.0 license.&nbsp;</p>\n\n<p><strong>Media contacts</strong>&nbsp;</p>\n\n<p>Emily Packer, eLife&nbsp;</p>\n\n<p>e.packer@elifesciences.org&nbsp;</p>\n\n<p>01223 855373&nbsp;</p>\n\n<p>Ulrike Glaubitz, Max Planck Institute of Molecular Plant Physiology&nbsp;</p>\n\n<p>glaubitz@mpimp-golm.mpg.de &nbsp;</p>\n\n<p>+49 331 567 8275&nbsp;</p>\n\n<p><strong>About eLife&nbsp;</strong></p>\n\n<p>eLife is a unique collaboration between the funders and practitioners of research to improve the way important research is selected, presented, and shared. eLife publishes outstanding works across the life sciences and biomedicine &#x2014; from basic biological research to applied, translational, and clinical studies. All papers are selected by active scientists in the research community. Decisions and responses are agreed by the reviewers and consolidated by the Reviewing Editor into a single, clear set of instructions for authors, removing the need for laborious cycles of revision and allowing authors to publish their findings quickly. eLife is supported by the Howard Hughes Medical Institute, the Max Planck Society, and the Wellcome Trust. Learn more at elifesciences.org.&nbsp;</p>\n",
        [
          'content' => "<p>A new and inexpensive technique for mass-producing the main ingredient in the most effective treatment for malaria, artemisinin, could help meet global demands for the drug, according to a study to be published in the journal eLife. </p>\n\n<p>Artemisinin is produced in low yields by a herb called <em>Artemisia annua</em> (<em>A. annua</em>), otherwise known as sweet wormwood. Researchers from the Max Planck Institute of Molecular Plant Physiology have now discovered a new way to produce artemisinic acid, the molecule from which artemisinin is derived, in high yields. Their method involves transferring its metabolic pathway &#x2013; the series of biochemical steps involved in its production &#x2013; from <em>A. annua</em> into tobacco, a high-biomass crop. </p>\n\n<p>&#x201C;Malaria is a devastating tropical disease that kills almost half a million people every year,&#x201D; says contributing author Ralph Bock, Director of the Department for Organelle Biology, Biotechnology and Molecular Ecophysiology. </p>\n\n<p>&#x201C;For the foreseeable future, artemisinin will be the most powerful weapon in the battle against malaria but, due to its extraction from low-yielding plants, it is currently too expensive to be widely accessible to patients in poorer countries. Producing artemisinic acid in a crop such as tobacco, which yields large amounts of leafy biomass, could provide a sustainable and inexpensive source of the drug, making it more readily available for those who need it most.&#x201D; </p>\n\n<p>The team has called this approach to producing more artemisinic acid COSTREL (&#x201C;combinatorial supertransformation of transplastomic recipient lines&#x201D;). The first step in their process was to transfer the genes of the artemisinic acid pathway&#x2019;s core set of enzymes into the chloroplast genome of tobacco plants, generating what are known as transplastomic plants. </p>\n\n<p>The team then used their best transplastomic tobacco plant line to introduce an additional set of genes into its nuclear genome, generating the COSTREL lines. These remaining genes encode factors that increase the synthesis, or generation, of the acid in ways that are still largely unknown. </p>\n\n<p>&#x201C;While the artemisinic acid pathway in <em>A. annua</em> is confined to the glandular hairs on the plant, leading to low yields of artemisinin, our COSTREL tobacco lines produce it in their chloroplasts and therefore the whole leaf,&#x201D; says lead author and postdoctoral researcher Paulina Fuentes. </p>\n\n<p>&#x201C;We generated over 600 engineered tobacco plant lines that harbour different combinations of these additional genes, and analysed them in terms of the amounts of artemisinic compounds they acquired. We could then identify those that generated unprecedented levels of 120 milligrams per kilogram of artemisinic acid in their leaves, which can be readily converted into artemisinin through simple chemical reactions.&#x201D; </p>\n\n<p>Although further increases in these production levels will be needed if global demand for artemisinin is to be met, the study lays the foundation for much cheaper production of this life-saving therapy in a high-biomass crop, in contrast to a single medicinal plant. </p>\n\n<p>It also provides a new tool for engineering many other complex pathways, with the potential to increase production of other essential therapeutic ingredients. </p>\n\n<p>## </p>\n\n<p>",
        ],
      ],
      [
        "<p>Scientists have found a way of predicting the clinical progression of HIV in infected individuals by measuring the levels of HIV-1 (Human Immunodeficiency Virus Type 1) DNA in white blood cells. The technique might be used to calculate how long it takes for the virus to return once treatment has been suspended.</p>\n<div>\n  Results are published in the journal eLife by Dr John Frater and colleagues at the University of Oxford (UK), University College London (UK), Imperial College London (UK), and The Kirby Institute of New South Wales (Australia).&nbsp;</div>\n<div>\n  &nbsp;</div>\n<div>\n  HIV is currently an incurable, chronic infection that is manageable on antiretroviral treatment (ART). However, once a patient stops receiving this treatment the virus almost always returns. At present, the standard way of measuring the progression of the disease within a patient is by measuring the amount of HIV within a small sample of blood, a measure known as the viral load. High viral loads are predictive of a more rapid disease progression.</div>\n<div>\n  &nbsp;</div>\n<div>\n  The next step in advancing our ability to potentially cure HIV is to find a way to predict how long it will take for the virus to rebound in patients on ART treatment when therapy is interrupted. In their paper, the team suggests that by measuring HIV-1 DNA -- some of which has been integrated into the genetic material inside patients&rsquo; cells -- it is possible to gain a clearer picture of this timeline.</div>\n<div>\n  &nbsp;</div>\n<div>\n  To find the link between HIV-1 DNA levels and clinical progression of the disease, the group measured HIV-1 DNA levels in the white blood cells (CD4 T cells) of 154 HIV-positive individuals before anti-HIV therapy, at the point of stopping therapy, and at regular time intervals after therapy. They then compared these levels with known markers of clinical progression.</div>\n<div>\n  &nbsp;</div>\n<div>\n  They found that the level of HIV-1 DNA within a patient&rsquo;s white blood cells corresponded directly with the time taken for persistent, detectable levels of HIV in the blood to return, having been undetectable as a result of the therapy. The researchers hope to be able to use this finding to predict how long it will take the virus to rebound once a patient has stopped antiretroviral medication.</div>\n<div>\n  &nbsp;</div>\n<div>\n  &ldquo;Many researchers are striving to find a cure for HIV infection. Although still a distant goal, our data suggest that some people might be more curable than others, and that it might be possible to design a series of tests to use in the clinic to help identify them,&rdquo; said John Frater, MRC Senior Clinical Fellow at Oxford University and co-senior author. &ldquo;In this way we might be able to advise as to who should stay on their current treatment and who might be a candidate for either a trial of stopping therapy or even a new treatment in the future.&rdquo;</div>\n<div>\n  &nbsp;</div>\n<div>\n  ###</div>\n<div>\n  &nbsp;</div>\n<div>\n  <strong>Reference</strong></div>\n<div>\n  The paper &lsquo;HIV-1 DNA predicts disease progression and post-treatment virological control&rsquo; can be freely accessed online at <a href=\"http://elifesciences.org/lookup/doi/10.7554/elife.03821\">elifesciences.org/lookup/doi/10.7554/elife.03821</a>. Contents, including text, figures, and data, are free to re-use under a CC BY 4.0 license.</div>\n<div>\n  &nbsp;</div>\n<div>\n  <strong>Media contacts&nbsp;</strong></div>\n<div>\n  Jennifer Mitchell, eLife</div>\n<div>\n  <a href=\"mailto:j.mitchell@elifesciences.org\">j.mitchell@elifesciences.org</a></div>\n<div>\n  +44 (0) 1223 855 373</div>\n<div>\n  &nbsp;</div>\n<div>\n  &nbsp;</div>\n<div>\n  <strong>About eLife Sciences Publications Ltd</strong></div>\n<div>\n  &nbsp;</div>\n<div>\n  eLife is a unique collaboration between the funders and practitioners of research to communicate ground-breaking discoveries in the life and biomedical sciences in the most effective way. The eLife journal is a platform for maximising the reach and influence of new discoveries and showcasing new approaches to the presentation, use, and assessment of research. eLife is supported by the Howard Hughes Medical Institute, the Max Planck Society, and the Wellcome Trust. Learn more at elifesciences.org.</div>\n",
        [
          'relatedContent' => [
            [
              'type' => 'article',
              'source' => '03821',
            ],
          ],
        ],
      ],
    ];
  }

}