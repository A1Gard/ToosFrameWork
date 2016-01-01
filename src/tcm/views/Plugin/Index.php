<?php
$prefix = GetLinkPrefix('order');

$listview = new TListView('plugin_id');
$listview->SetList($this->plugins);
$listview->AddColum(_lg('plugin name'), 'plugin_name', 10);
$listview->AddColum(_lg('plugin author'), 'plugin_author', 10);
$listview->SetPattern(1, '<img src="' . UR_MP_ASSETS . 'images/active%s.png" alt="[plugin status]" />');
$listview->AddColum(_lg('status'), '%1plugin_status', 2);
$listview->AddColum('', 'plugin_discrption', 16);
$pattern = '<a class="button delete" href="' . UR_MP . 'Plugin/Delete/%id%"> ' . _lg('Delete') . ' </a>
                <a class="button active" href="' . UR_MP . 'Plugin/Status/%id%/1"> ' . _lg('Active') . ' </a>
                <a class="button deactive" href="' . UR_MP . 'Plugin/Status/%id%/0"> ' . _lg('Deactive') . '</a>';
$listview->AddAction($pattern, 6, 'plugin_status');


$listview->AddFilter(_lg('Deactived'), 'plugin_status', '0');
$listview->AddFilter(_lg('Actived'), 'plugin_status', '1');

$listview->AddBulkAcction(_lg('Deactive'), 'Edit', 'plugin_status,0');
$listview->AddBulkAcction(_lg('Active'), 'Edit', 'plugin_status,1');
$listview->AddBulkAcction(_lg('Delete'), 'Delete', null);

$listview->Render('Plugin');

$frm = new TForm(UR_MP . 'Plugin/upload');
$frm->AddField('file', _lg('zip file'), null, array('name' => 'file'));
$frm->AddField('submit', '', _lg('Upload'));
?>
<br />

<div style="background: #1392e9;padding:1em;margin:1em;">
    <h2>
        <?php _lp('Upload new plugin') ?>
    </h2>
    <br />
    <?php
    $frm->Render();
    ?>
</div>
<style type="text/css">
    .c1 .active{
        display: none;
    }
    .c0 .deactive{
        display: none;
    }
</style>

