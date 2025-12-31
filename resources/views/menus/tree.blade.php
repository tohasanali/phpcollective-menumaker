<?php
$traverse = function ($menus) use (&$traverse, $selected) {
    foreach ($menus as $menu) {
        echo '<li data-id="' . $menu->id . '" class="mb-2">';
        echo '<div class="d-flex justify-content-between align-items-center">';
        
        $checked = '';
        if (in_array($menu->id, $selected)) {
            $checked = 'checked';
        }
        
        echo '<div class="form-check">';
        echo '<input class="form-check-input" ' . $checked . ' name="menu_ids[]" type="checkbox" value="' . $menu->id . '" id="menu-' . $menu->id . '">';
        echo '<label class="form-check-label" for="menu-' . $menu->id . '">' . $menu->name . '</label>';
        echo '</div>';

        echo '<span class="handle mr-2" style="cursor: move;">&#9776;</span>';
        echo '</div>';

        echo '<ul class="sortable-tree">';
        if ($menu->children->isNotEmpty()) {
            $traverse($menu->children);
        }
        echo '</ul>';
        echo '</li>';
    }
};
?>
<ul class="sortable-tree">
    <?php $traverse($tree); ?>
</ul>
