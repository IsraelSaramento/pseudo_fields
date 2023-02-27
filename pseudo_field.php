<?php

use Drupal\Core\Entity\Display\EntityViewDisplayInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\node\Entity\Node;
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

/**
* Implements hook_entity._type_view().
* Render pseudo fields
*/
function my_module_node_view(array &$build, EntityInterface $entity, EntityViewDisplayInterface $display, $view_mode) {

 if ($display->getComponent('my_pseudo_field')) {
   $article_id = $entity->field_article_reference->target_id;
   $article = Node::load($article_id);
  
   $build['my_pseudo_field'] =  $article
     ->get('field_description')
     ->view('full');
 }
}

// Render example 1.
$build['my_pseudo_field'] = [
 '#theme' => 'field',
 '#title' => 'Custom title',
 '#label_display' => 'inline',
 '#attributes' => [
   'class' => 'field field--name-field-custom-title'
 ],
];

// Render example 2.
$build['my_pseudo_field'] =  $article
  ->get('field_description')
  ->view('full');
$build['my_pseudo_field'][] =  $article
  ->get('field_image')
  ->view('teaser');
