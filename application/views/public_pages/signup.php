

<?php echo form_open('page/signup_process', 'signup_form',''); ?>
    <?php echo validation_errors('<span class="error">', '</span>'); ?>
    <label for="email">Email</label>
    <input type="text" name="email" value="" id="email>
    <label for="password">Password</label>
    <input type="text" name="password" value="" id="password">

    <button type="submit">Signup</button>
</form>