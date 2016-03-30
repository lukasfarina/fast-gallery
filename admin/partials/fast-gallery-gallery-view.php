<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.lucasfarina.com.br
 * @since      1.0.0
 *
 * @package    Fast_Gallery
 * @subpackage Fast_Gallery/admin/partials
 */

// Get $gallery options
$gallery = unserialize( get_post_meta($post->ID, 'gallery', true ) );
$gallery = !empty($gallery) ? $gallery : array();
?>
<ul class="fast-gallery-container">
    <?php if(count($gallery) > 0):
    foreach ($gallery as $key => $imageId) : ?>
    <li>
        <input type="hidden" name="gallery[]" class="fast-gallery-image-id" value="<?php echo $imageId; ?>"/> <!-- TODO: Adicionar thumbnail size do Fast Gallery -->
        <div class="fast-gallery-image-container"
             style="background: url('<?php $bg = wp_get_attachment_image_src($imageId, 'fast-gallery-thumbnail'); echo $bg[0]; ?>') no-repeat;">
        </div>

        <div class="actions">
            <button type="button" class="fast-gallery_change_image">
                <span class="dashicons-before dashicons-edit"></span>
                <?php _e('Troca Imagem', $this->plugin_name); ?>
            </button>
            <button type="button" class="fast-gallery_remove_image">
                <span class="dashicons-before dashicons-trash"></span>
                <?php _e('Remover Imagem', $this->plugin_name); ?>
            </button>
        </div>
    </li>
    <?php endforeach; endif; ?>

    <li>
        <button class="fast-gallery_add_image" title="<?php _e('Adicionar Imagem', $this->plugin_name); ?>">
            <span class="dashicons-before dashicons-plus-alt"></span>
        </button>
    </li>
</ul>

<script id="item-template" type="text/html">
    <li class="current-item">
        <input type="hidden" name="gallery[]" class="fast-gallery-image-id" value=""/>
        <div class="fast-gallery-image-container"></div>

        <div class="actions">
            <button type="button" class="fast-gallery_change_image">
                <span class="dashicons-before dashicons-edit"></span>
                <?php _e('Troca Imagem', $this->plugin_name); ?>
            </button>
            <button type="button" class="fast-gallery_remove_image">
                <span class="dashicons-before dashicons-trash"></span>
                <?php _e('Remover Imagem', $this->plugin_name); ?>
            </button>
        </div>
    </li>
</script>


