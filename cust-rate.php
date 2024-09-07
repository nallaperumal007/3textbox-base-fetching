<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multiple Rows</title>
    <style>
         body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            padding: 20px;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 40px;
        }
        h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-success {
            background-color: #28a745;
            color: #fff;
        }
        .btn-info {
            background-color: #17a2b8;
            color: #fff;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-danger:hover, .btn-success:hover, .btn-info:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
<div class="container">
    <h3><u>Customers Name</u></h3>
    <form id="freightForm" action="insert_data.php" method="post">
       
          
          
           
             

    <h3><u>Inserting Multiple Rows</u></h3>
       <select name="name[]"></select></td>
                <input type="text" name="Code[]" placeholder="Enter Code">
                <input type="text" name="Branch[]" placeholder="Enter Branch">
           
           
         
     

        <button type="submit" class="btn btn-info">Submit</button>
    
        <table id="freightTable" class="table">
            <thead>
            <tr>
                <th>ORG</th>
                <th>DEST</th>


                <th>Veh.Type</th>
                <th>Rate (1-way)</th>
                <th>Km-Rate</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><select name="org[]"  style="width:200px"  ></select></td>
                <td><select name="dest[]"  style="width:200px"  ></select></td>

				<!--
                <td><select name="mode[]"></select></td>
                <td><input type="text" name="gst[]" placeholder="Enter GST"></td>-->
				
                <td><input type="text" name="veh_type[]" placeholder="Veh.Type" required value=""></td>
                <td><input type="text" name="rate[]" placeholder="Trip-Cost" required value="0"></td>
                <td><input type="text" name="km_rate[]" placeholder="Km.Rate" required value="0"></td>

                <td><button type="button" class="removerow btn btn-danger btnRemove">Remove</button></td>
            </tr>
            </tbody>
        </table>

        <button type="button" id="addrowFreight" class="btn btn-success">Add New Row</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {

        // Function to fetch city-based ORG options
        function fetchOrgOptions(selectElement) {
            $.ajax({
                url: 'fetch_branches.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Select ORG</option>';
                    for (var i = 0; i < response.length; i++) {
                        options += '<option value="' + response[i].brcode + '">' + response[i].city + '</option>';
                    }
                    selectElement.html(options);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching ORG options:', error);
                }
            });
        }

        // Function to fetch city-based DEST options
        function fetchDestOptions(selectElement) {
            $.ajax({
                url: 'fetch_branches1.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Select Dest</option>';
                    for (var i = 0; i < response.length; i++) {
                        options += '<option value="' + response[i].brcode + '">' + response[i].city + '</option>';
                    }
                    selectElement.html(options);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching dest options:', error);
                }
            });
        }


        // Function to fetch customer names
         function fetchNameOptions(selectElement) {
        $.ajax({
            url: 'fetch_customer.php', // Adjust URL as per your server endpoint
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var options = '<option value="">Select Customer Name</option>';
                for (var i = 0; i < response.length; i++) {
                    var value = response[i].brcode + '-' + response[i].cust_code;
                    var name = response[i].cust_name;
                    options += '<option value="' + value + '">' + name + '</option>';
                }
                $(selectElement).html(options);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching customer names:', error);
                // Optionally handle errors here
            }
        });
    }
  

 fetchNameOptions('select[name="name[]"]');

    // Event listener for dynamically added rows (using delegation)
 $('select[name="name[]"]').on('change', function() {
        var selectedName = $(this).val(); // Get the selected customer name value
        var branchInput = $(this).closest('form').find('input[name="Branch[]"]');
        var codeInput = $(this).closest('form').find('input[name="Code[]"]');

        // Check if branchInput and codeInput exist and update them accordingly
        if (branchInput.length > 0 && codeInput.length > 0) {
            var parts = selectedName.split('-');
            var branch = parts[0]; // Extract branch from selectedName
            var code = parts[1];   // Extract code from selectedName

            branchInput.val(branch); // Set branchInput value
            codeInput.val(code);     // Set codeInput value
        }
    });


        // Call fetchOrgOptions, fetchDestOptions, fetchTranOptions, and fetchNameOptions on page load for the initial row
        fetchOrgOptions($('select[name="org[]"]'));
        fetchDestOptions($('select[name="dest[]"]'));
       // fetchTranOptions($('select[name="mode[]"]'));
        fetchNameOptions($('select[name="name[]"]'));

        // Event listener for ORG selection to populate ORG-CODE
        $('#freightTable').on('change', 'select[name="org[]"]', function() {
            var selectedOrg = $(this).val();
            var orgCodeInput = $(this).closest('tr').find('input[name="orgCode[]"]');
            if (orgCodeInput) {
                orgCodeInput.val(selectedOrg);
            }
        });

        // Event listener for DEST selection to populate DEST-CODE
        $('#freightTable').on('change', 'select[name="dest[]"]', function() {
            var selectedDest = $(this).val();
            var destCodeInput = $(this).closest('tr').find('input[name="destCode[]"]');
            if (destCodeInput) {
                destCodeInput.val(selectedDest);
            }
        });

		
		

        // Add new row to freight table
        $('#addrowFreight').click(function() {
            var newRow = 
                `<tr>
                <td><select name="rout_org[]"  style="width:200px"  ></select></td>
                <td><select name="rout_dest[]"  style="width:200px"  ></select></td>
                <td><input type="text" name="veh_type[]" placeholder="Veh.Type" required value=""></td>
                <td><input type="text" name="rate[]" placeholder="Trip-Cost" required value="0"></td>
                <td><input type="text" name="km_rate[]" placeholder="Km.Rate" required value="0"></td>
                    <td><button type="button" class="removerow btn btn-danger btnRemove">Remove</button></td>
                </tr>`;
            $('#freightTable').append(newRow);

            // Fetch fresh options for the new row
            var newOrgSelect = $('#freightTable').find('tr:last').find('select[name="org[]"]');
            var newDestSelect = $('#freightTable').find('tr:last').find('select[name="dest[]"]');
           // var newModeSelect = $('#freightTable').find('tr:last').find('select[name="mode[]"]');
            fetchOrgOptions(newOrgSelect);
            fetchDestOptions(newDestSelect);
           // fetchTranOptions(newModeSelect);
        });

        // Remove row from freight table
        $('#freightTable').on('click', '.removerow', function() {
            $(this).closest('tr').remove();
        });

    });
</script>



</body>
</html>
