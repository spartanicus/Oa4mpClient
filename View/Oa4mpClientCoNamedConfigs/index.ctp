<?php
/**
 * COmanage Registry Oa4mp Client Plugin CO Named Config Index View
 *
 * Portions licensed to the University Corporation for Advanced Internet
 * Development, Inc. ("UCAID") under one or more contributor license agreements.
 * See the NOTICE file distributed with this work for additional information
 * regarding copyright ownership.
 *
 * UCAID licenses this file to you under the Apache License, Version 2.0
 * (the "License"); you may not use this file except in compliance with the
 * License. You may obtain a copy of the License at:
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * @link          http://www.internet2.edu/comanage COmanage Project
 * @package       registry
 * @since         COmanage Registry v2.0.1
 * @license       Apache License, Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 */

  // Add breadcrumbs
  $this->Html->addCrumb(_txt('ct.oa4mp_client_co_named_configs.pl'));

  // Add page title
  $params = array();
  $params['title'] = $title_for_layout;

  // Add top links
  $params['topLinks'] = array();

  if($permissions['add']) {
    $params['topLinks'][] = $this->Html->link(
      _txt('op.add.new', array(_txt('ct.oa4mp_client_co_named_configs.1'))),
      array(
        'plugin' => 'oa4mp_client',
        'controller' => 'oa4mp_client_co_named_configs',
        'action' => 'add'
      ),
      array('class' => 'addbutton')
    );
  }

  print $this->element("pageTitleAndButtons", $params);
?>

<div class="table-container">

<table id="oa4mp_client_co_named_configs" class="ui-widget">
  <thead>
    <tr class="ui-widget-header">
      <th><?php
          $args = array();
          print $this->Paginator->sort('Oa4mpClientCoAdminClient.id', _txt('co'), $args);
          ?>
      </th>
      <th><?php
          $args = array();
          print $this->Paginator->sort('config_name', _txt('pl.oa4mp_client_co_named_config.config_name.fd'), $args);
          ?>
      </th>
      <th class="thinActionButtonsCol"><?php print _txt('fd.actions'); ?></th>
    </tr>
  </thead>
  
  <tbody>
    <?php $i = 0; ?>
    <?php foreach ($oa4mp_client_co_named_configs as $c): ?>
    <tr class="line<?php print ($i % 2)+1; ?>">
      <td>
        <?php
          print $this->Html->link(
            $c['Co']['name'],
            array(
              'plugin' => 'oa4mp_client',
              'controller' => 'oa4mp_client_co_named_configs',
              'action' => ($permissions['edit'] ? 'edit' : ($permissions['view'] ? 'view' : '')),
              $c['Oa4mpClientCoNamedConfig']['id']
            )
          );
        ?>
      </td>
      <td>
        <?php
          print $this->Html->link(
            $c['Oa4mpClientCoNamedConfig']['config_name'],
            array(
              'plugin' => 'oa4mp_client',
              'controller' => 'oa4mp_client_co_named_configs',
              'action' => ($permissions['edit'] ? 'edit' : ($permissions['view'] ? 'view' : '')),
              $c['Oa4mpClientCoNamedConfig']['id']
            )
          );
        ?>
      </td>
      <td>
        <?php
          if($permissions['edit']) {
            print $this->Html->link(
                _txt('op.edit'),
                array(
                  'plugin' => 'oa4mp_client',
                  'controller' => 'oa4mp_client_co_named_configs',
                  'action' => 'edit', $c['Oa4mpClientCoNamedConfig']['id']
                ),
                array('class' => 'editbutton')) . "\n";
          }
          if($permissions['delete']) {
            print '<button type="button" class="deletebutton" title="' . _txt('op.delete')
              . '" onclick="javascript:js_confirm_generic(\''
              . _txt('js.remove') . '\',\''    // dialog body text
              . $this->Html->url(              // dialog confirm URL
                array(
                  'plugin' => 'oa4mp_client',
                  'controller' => 'oa4mp_client_co_named_configs',
                  'action' => 'delete',
                  $c['Oa4mpClientCoNamedConfig']['id']
                )
              ) . '\',\''
              . _txt('op.remove') . '\',\''    // dialog confirm button
              . _txt('op.cancel') . '\',\''    // dialog cancel button
              . _txt('op.remove') . '\',[\''   // dialog title
              . filter_var(_jtxt($c['Oa4mpClientCoNamedConfig']['config_name']),FILTER_SANITIZE_STRING)  // dialog body text replacement strings
              . '\']);">'
              . _txt('op.delete')
              . '</button>';
          }
        ?>
        <?php ; ?>
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
  </tbody>
  
  <tfoot>
    <tr class="ui-widget-header">
      <th colspan="3">
        <?php print $this->element("pagination"); ?>
      </th>
    </tr>
  </tfoot>
</table>

</div>
