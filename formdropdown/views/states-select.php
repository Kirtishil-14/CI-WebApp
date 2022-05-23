<select name="state" id="state">
    <option value="">Select State</option>
    <?php
    if (!empty($states)) {
        foreach ($states as $state) {
    ?>
    <option value="<?php echo $state['id']; ?>"><?php echo $state['name']; ?></option>
    <?php
        }
    }
    ?>
</select>