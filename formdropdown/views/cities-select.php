<select name="city" id="city">
    <option value="">Select City</option>
    <?php
    if (!empty($cities)) {
        foreach ($cities as $city) {
    ?>
    <option value="<?php echo $city['id']; ?>"><?php echo $city['name']; ?></option>
    <?php
        }
    }
    ?>
</select>