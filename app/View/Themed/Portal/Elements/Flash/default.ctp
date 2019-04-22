<div id="<?php echo $key; ?>Message" class="myadmin-alert myadmin-alert-icon myadmin-alert-click alert-info myadmin-alert-top alerttop" style="display:block; z-index:1500">
    <i class="ti-user"></i> <?php echo $message; ?> <?php echo (!empty($params['name']) && !empty($params['id'])) ? '(' . $params['name'] .':' . $params['id'] . ')' : ''; ?> <a href="#" class="closed">×</a>
</div>