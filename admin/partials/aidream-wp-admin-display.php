<form method="post">
    <?php wp_nonce_field( 'save-meta', '_wpnonce_save-meta' ) ?>
    <table class="form-table">
        <tr class="form-field form-required">
            <th scope="row">
                <label for="select_post"><?php _e('Select Post'); ?>
            </th>
            <td>
                <select name="post_id" id="select_post" aria-required="true" value="" required>
                    <option value="" disabled selected><?php _e('Please select a page or post'); ?></option>
                    <?php foreach ($posts as $post) { ?>
                        <option value="<?php echo $post['id']; ?>"><?php echo $post['title']; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>

        <tr class="form-field form-required">
            <th scope="row">
                <label for="meta_title"><?php _e('Meta Title'); ?>
            </th>
            <td>
                <input type="text" name="meta_title" id="meta_title" maxlength="70" aria-required="true" required>
            </td>
        </tr>

        <tr class="form-field form-required">
            <th scope="row">
                <label for="meta_desc"><?php _e('Meta Description'); ?>
            </th>
            <td>
                <textarea name="meta_description" id="meta_desc" maxlength="160" rows="5" aria-required="true" required></textarea>
            </td>
        </tr>
    </table>
    <?php submit_button( __( 'Save'), 'primary', 'save_meta' ); ?>
</form>
