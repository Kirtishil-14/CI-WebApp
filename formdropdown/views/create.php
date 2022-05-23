<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dynamic Dropdown</title>
    </head>

    <body>
        <form action="" method="post" id="createForm" name="createForm">
            <div>
                <input type="text" name="name" id="name" value="">
                <label for="">Name</label>
                <input type="text" name="email" id="email" value="">
                <label for="">Email</label>
                <label for="">Country</label>
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
                <div id="stateBox">
                    <label for="">State</label>
                    <select name="state" id="state">
                        <option value="">Select State</option>
                    </select>
                </div>
                <div id="cityBox">
                    <label for="">City</label>
                    <select name="city" id="city">
                        <option value="">Select City</option>
                    </select>
                </div>
                <button type="submit" name="create">Create</button>
            </div>
        </form>

    </body>

    <script>
    var uname = document.getElementById("name");
    var email = document.getElementById("email");
    var country = document.getElementById('country');
    var state = document.getElementById('state');
    var city = document.getElementById('city');
    var formSubmitted = document.getElementById('createForm');

    document.addEventListener('change', function(event) {
        event.preventDefault();

        if (event.target.id == 'country') {
            var countryId = event.target.value;

            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '<?php echo base_url('home/getStates'); ?>/' + countryId);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var res = (this.responseText);
                    var res_arry = JSON.parse(res);
                    if (res_arry['result'] == '200' && res_arry['states']) {
                        var state = document.getElementById('stateBox');
                        state.innerHTML = res_arry['states'];

                        var city = document.getElementById('cityBox');
                        const str1 = `<select name="city" id="city">
                                            <option value="">Select City</option>
                                        </select>`
                        city.innerHTML = str1;
                    }
                }
            };
            xhttp.setRequestHeader("Content-type", "application/json");

            if (countryId)
                xhttp.send();
            else {
                var state = document.getElementById('stateBox');
                const str = `<select name="state" id="state">
                                            <option value="">Select State</option>
                                        </select>`
                state.innerHTML = str;


                var city = document.getElementById('cityBox');
                const str1 = `<select name="city" id="city">
                                            <option value="">Select City</option>
                                        </select>`
                city.innerHTML = str1;
            }
        }

        if (event.target.id == 'state') {
            var stateId = event.target.value;

            var xhttp = new XMLHttpRequest();
            xhttp.open('POST', '<?php echo base_url('home/getCities'); ?>/' + stateId);
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var res = (this.responseText);
                    var res_arry = JSON.parse(res);
                    if (res_arry['result'] == '200' && res_arry['cities']) {
                        var city = document.getElementById('cityBox');
                        city.innerHTML = res_arry['cities'];
                    }
                }
            };
            xhttp.setRequestHeader("Content-type", "application/json");

            if (stateId)
                xhttp.send();
            else {
                var city = document.getElementById('cityBox');
                const str = `<select name="city" id="city">
                                            <option value="">Select City</option>
                                        </select>`
                city.innerHTML = str;
            }
        }

    });



    formSubmitted.addEventListener('submit', function(event) {
        event.preventDefault();

        var param = {
            name: uname.value,
            email: email.value,
            country: document.getElementById("country").value,
            state: document.getElementById("state").value,
            city: document.getElementById("city").value,
        };

        fetch('<?php echo base_url('home/saveUsers'); ?>', {
            method: 'post',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(param)
        }).then(response => response.json()).then(data => {
            console.log(data);
            window.location.href = '<?php echo base_url('home/index') ?>';
        }).catch((error) => {
            console.error(error);
        })

    });
    </script>

</html>