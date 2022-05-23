<form action="" method="POST" id="editCarModel" name="editCarModel">
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
    <label for="">Name</label>
    <input type=" text" name="name" id="name" value="<?php echo $row['name']; ?>">
    <p class="nameError"></p>
    <button type="submit">Save</button>
</form>