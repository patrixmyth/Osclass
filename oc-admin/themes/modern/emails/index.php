<?php
    /**
     * OSClass – software for creating and publishing online classified advertising platforms
     *
     * Copyright (C) 2010 OSCLASS
     *
     * This program is free software: you can redistribute it and/or modify it under the terms
     * of the GNU Affero General Public License as published by the Free Software Foundation,
     * either version 3 of the License, or (at your option) any later version.
     *
     * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
     * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
     * See the GNU Affero General Public License for more details.
     *
     * You should have received a copy of the GNU Affero General Public
     * License along with this program. If not, see <http://www.gnu.org/licenses/>.
     */

    function customPageHeader(){ ?>
        <h1><?php _e('Settings') ; ?>
            <a href="#" class="btn ico ico-32 ico-help float-right"></a>
        </h1>
<?php
    }
    osc_add_hook('admin_page_header','customPageHeader');

    function customPageTitle($string) {
        return sprintf(__('Emails templates &raquo; %s'), $string);
    }
    osc_add_filter('admin_title', 'customPageTitle');

    $aData = __get('aEmails'); 

    osc_current_admin_theme_path( 'parts/header.php' ) ; ?>
<h2 class="render-title"><?php _e('Emails templates'); ?></h2>
<div class="table-contains-actions">
    <table class="table" cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?php _e('Name') ; ?></th>
                <th><?php _e('Title') ; ?></th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($aData['aaData'])>0) { ?>
        <?php foreach( $aData['aaData'] as $array) { ?>
            <tr>
            <?php foreach($array as $key => $value) { ?>
                <td>
                <?php echo $value; ?>
                </td>
            <?php } ?>
            </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
            <td colspan="6" style="text-align: center;">
            <p><?php _e('No data available in table') ; ?></p>
            </td>
        </tr>
        <?php } ?>
        </tbody>
    </table>
    <div id="table-row-actions"></div> <!-- used for table actions -->
</div>
<div class="has-pagination">
<?php
    $pageActual = Params::getParam('iPage') ;
    $urlActual  = osc_admin_base_url(true).'?'.$_SERVER['QUERY_STRING'];
    $urlActual  = preg_replace('/&iPage=(\d)+/', '', $urlActual) ;
    $pageTotal  = ceil($aData['iTotalDisplayRecords']/$aData['iDisplayLength']);
    $params = array('total'    => $pageTotal
                   ,'selected' => $pageActual-1
                   ,'url'      => $urlActual.'&iPage={PAGE}'
                   ,'sides'    => 5
        );
    $pagination = new Pagination($params);
    $aux = $pagination->doPagination();

    echo $aux;
?>
</div>
<?php osc_current_admin_theme_path( 'parts/footer.php' ) ; ?>