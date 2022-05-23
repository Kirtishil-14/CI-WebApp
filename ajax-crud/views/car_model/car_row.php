<tr id="row-<?php echo $row['id']; ?>">
    <td class="modelId"><?php echo $row['id']; ?></td>
    <td class="modelName"><?php echo $row['name']; ?></td>
    <td class="modelCreatedAt"><?php echo $row['created_at']; ?></td>
    <td class="modelUpdatedAt"><?php echo $row['updated_at']; ?></td>
    <td><button type="button" onclick="showEditForm(<?php echo $row['id']; ?>)">Edit</button></td>
    <td><button type="button" onclick="confirmDeleteModel(<?php echo $row['id']; ?>)">Delete</button></td>
</tr>