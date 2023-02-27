<?php


use Drupal\node\Entity\NodeType;


/**
* Implements hook_entity_extra_field_info().
* Create pseudo fields.
*/
function my_module_entity_extra_field_info() {
 $extra = [];


foreach (NodeType::loadMultiple() as $bundle) {


 if ($bundle->get('type') === 'blog') {
   $extra['node'][$bundle->Id()]['display']['my_pseudo_field'] = [
     'label' => t('Hi! Im a pseudo field'),
     'description' => t('This is a pseudo field'),
     'weight' => 100,
     'visible' => TRUE,
   ];
 }


 return $extra;
}
