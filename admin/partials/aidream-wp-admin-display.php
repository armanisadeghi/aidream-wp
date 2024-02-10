<form method="post">
    <?php wp_nonce_field('save-meta', '_wpnonce_save-meta'); ?>
            <!-- Title for AI Matrix WordPress Plugin -->

    <table class="form-table">
        <tr>
            <td colspan="12" class="page_title">AI Matrix WordPress Plugin</td>
        </tr>
        <!-- Existing form content -->
        <tr class="form-field form-required">
            <th scope="row">
                <label for="select_post"><?php _e('Select Post'); ?></label>
            </th>
            <td>
                <select name="post_id" id="select_post" aria-required="true" required>
                    <option value="" disabled selected><?php _e('Please select a page or post'); ?></option>
                    <?php foreach ($posts as $post) { ?>
                        <option value="<?php echo $post['id']; ?>"><?php echo $post['title']; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>


        <!-- Metadata Section -->
        <tr>
            <td colspan="12" class="heading-section">PAGE METADATA</td>
        </tr>

        <tr class="form-field form-required">
            <th scope="row">
                <label for="meta_title"><?php _e('Meta Title'); ?>
            </th>
            <td>
                <input type="text" name="meta_title" id="meta_title" maxlength="70" aria-required="true" required>
            </td>
            <td>
                <input type="text" name="meta_title" id="ame_meta_title" maxlength="70" aria-required="true" required>
            </td>
        </tr>

        <tr class="form-field form-required">
            <th scope="row">
                <label for="meta_desc"><?php _e('Meta Description'); ?>
            </th>
            <td>
                <textarea name="meta_description" id="meta_desc" maxlength="160" rows="5" aria-required="true" required></textarea>
            </td>
            <td>
                <textarea name="meta_description" id="ame_meta_desc" maxlength="160" rows="5" aria-required="true" required></textarea>
            </td>
        </tr>

        <!-- Headings Section -->
        <tr>
            <td colspan="12" class="heading-section">HEADINGS</td>
        </tr>
        
        <!-- Placeholder for Headings -->
        <tr id="headings-placeholder" class="form-field form-required"></tr>
        
        <!-- Images Section -->
        <tr>
            <td colspan="12" class="heading-section">IMAGES</td>
        </tr>
        
        <!-- Placeholder for Images -->
        <tr id="images-placeholder" class="form-field form-required"></tr>
        
    </table>
    <?php submit_button(__('Update Page'), 'primary', 'save_meta'); ?>
</form>
