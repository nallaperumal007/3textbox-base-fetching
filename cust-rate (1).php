<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multiple Rows</title>
    <style>
        /* Add your CSS styles here */
    
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
        .type-textboxes {
            display: flex;
            gap: 10px;
        }
        .type-textboxes input {
            width: 100px;
        }
    
    </style>
</head>
<body>
<div class="container">
    <h3><u>Customers Name</u></h3>
    <form id="freightForm" action="insert_data.php" method="post">
        <h3><u>Inserting Multiple Rows</u></h3>
        <select name="name[]" class="nameDropdown"></select>
        <input type="text" name="name1[]" placeholder="Enter Customer Name">
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
                    <th>Type</th>
                    <th>Selected Type</th>
                    <th>Type Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><select name="org[]" style="width:200px"></select></td>
                    <td><select name="dest[]" style="width:200px"></select></td>
                    <td><input type="text" name="veh_type[]" placeholder="Veh.Type" required></td>
                    <td><input type="text" name="rate[]" placeholder="Trip-Cost" required value="0"></td>
                    <td><input type="text" name="km_rate[]" placeholder="Km.Rate" required value="0"></td>
                    <td>
                        <select name="type[]" class="typeDropdown">
                            <option value="">Select Type</option>
                            <option value="a">Type A</option>
                            <option value="b">Type B</option>
                        </select>
                    </td>
                    <td class="selectedType">Selected type will appear here</td>
                    <td>
                        <div class="type-textboxes"></div>
                    </td>
                    <td><button type="button" class="removerow btn btn-danger">Remove</button></td>
                </tr>
            </tbody>
        </table>

        <button type="button" id="addrowFreight" class="btn btn-success">Add New Row</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
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
                    console.error('Error fetching DEST options:', error);
                }
            });
        }

        function fetchNameOptions(selectElement) {
            $.ajax({
                url: 'fetch_customer.php',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var options = '<option value="">Select Customer Name</option>';
                    for (var i = 0; i < response.length; i++) {
                        var value = response[i].brcode + '-' + response[i].cust_code;
                        var name = response[i].cust_name;
                        options += '<option value="' + value + '" data-brcode="' + response[i].brcode + '">' + name + '</option>';
                    }
                    $(selectElement).html(options);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching customer names:', error);
                }
            });
        }

        function updateTypeTextboxes(row) {
            var selectedType = row.find('select[name="type[]"]').val();
            var textboxesContainer = row.find('.type-textboxes');
            var selectedTypeCell = row.find('.selectedType');

            textboxesContainer.empty();

            if (selectedType === 'a') {
                selectedTypeCell.text('Type A Selected');
                textboxesContainer.append(`
                    <input type="text" name="type_name_a[]" value="0" placeholder="Text A1">
                    <input type="text" name="type_name_a[]"  value="0" placeholder="Text A2">
                    <input type="text" name="type_name_a[]" value="0" placeholder="Text A3">
                `);
            } else if (selectedType === 'b') {
                selectedTypeCell.text('Type B Selected');
                
            } else {
                selectedTypeCell.text('');
            }
        }

        function setupRow(row) {
            fetchOrgOptions(row.find('select[name="org[]"]'));
            fetchDestOptions(row.find('select[name="dest[]"]'));
            updateTypeTextboxes(row);
        }

        function updateCustomerFields(selectElement) {
            var selectedValue = $(selectElement).val();
            var selectedText = $(selectElement).find('option:selected').text();
            var branchCode = $(selectElement).find('option:selected').data('brcode');

            $(selectElement).closest('form').find('input[name="name1[]"]').val(selectedText);
            $(selectElement).closest('form').find('input[name="Code[]"]').val(selectedValue.split('-')[1]);
            $(selectElement).closest('form').find('input[name="Branch[]"]').val(branchCode);
        }

        fetchNameOptions('select[name="name[]"]');
        fetchOrgOptions($('select[name="org[]"]'));
        fetchDestOptions($('select[name="dest[]"]'));

        $('select[name="name[]"]').on('change', function() {
            updateCustomerFields(this);
        });

        $('#addrowFreight').click(function() {
            var newRow = 
                `<tr>
                <td><select name="org[]" style="width:200px"></select></td>
                <td><select name="dest[]" style="width:200px"></select></td>
                <td><input type="text" name="veh_type[]" placeholder="Veh.Type" required></td>
                <td><input type="text" name="rate[]" placeholder="Trip-Cost" required value="0"></td>
                <td><input type="text" name="km_rate[]" placeholder="Km.Rate" required value="0"></td>
                <td>
                    <select name="type[]" class="typeDropdown">
                        <option value="">Select Type</option>
                        <option value="a">Type A</option>
                        <option value="b">Type B</option>
                    </select>
                </td>
                <td class="selectedType">Selected type will appear here</td>
                <td>
                    <div class="type-textboxes"></div>
                </td>
                <td><button type="button" class="removerow btn btn-danger">Remove</button></td>
                </tr>`;
            $('#freightTable tbody').append(newRow);

            var lastRow = $('#freightTable tbody tr').last();
            setupRow(lastRow);

            lastRow.find('select[name="type[]"]').on('change', function() {
                updateTypeTextboxes($(this).closest('tr'));
            });
        });

        $('#freightTable').on('click', '.removerow', function() {
            $(this).closest('tr').remove();
        });

        $('#freightTable').on('change', 'select[name="type[]"]', function() {
            updateTypeTextboxes($(this).closest('tr'));
        });
    });
</script>
</body>
</html>
