<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Dropdown</title>
</head>

<body>
    <div>
        <input type="text" name="name" id="name" value="">
        <input type="text" name="email" id="email" value="">
        <select name="country" id="country">
            <option value="">Select Country</option>
            <?php
            if (!empty($countries)) {
                foreach ($countries as $country) {
                    echo "<option value='" . $country['id'] . "'>" . $country['name'] . "</option>";
                }
            }
            ?>
        </select>
        <select name="state" id="state">
            <option value="">Select State</option>
        </select>
        <select name="city" id="city">
            <option value="">Select City</option>
        </select>
        <button type="submit" name="">Create</button>
    </div>
</body>

<script>
    var country = document.getElementById('country');
    var state = document.getElementById('state');
    var city = document.getElementById('city');

    country.addEventListener('change', function() {
        var countryId = this.value;
        alert(countryId);

        var xhttp = new XMLHttpRequest();
        xhttp.open('POST', '<?php echo base_url('home/getStates'); ?>/'+countryId);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var res = (this.responseText);
                console.log(res)
                var res_arry = JSON.parse(res);
                if (res_arry['result'] == '200') {


                }
            }
        };
        var param = {
            countryId: countryId
        };
        xhttp.setRequestHeader("Content-type", "application/json");
        xhttp.send();


    });
</script>

</html>