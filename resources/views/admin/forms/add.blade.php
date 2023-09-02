@extends('layouts.adminlayout');
@section('content')
<div class="col-md-6 d-flex mb-2" style="margin-left: 200px;">
    <label for="formName"><b>Form Name:</b></label>
    <input type="text" id="name" name="name" class="form-control" placeholder="Enter Form Name" required>
</div>
<div id="builder"></div>
<button id="submitButton" class="btn btn-primary">Submit </button>
<!-- Bootstrap alert message container -->
<div id="alertMessage" class="alert" style="display: none;"></div> <!-- Add this line -->
<script>
// Initialize Formio builder
Formio.builder(document.getElementById('builder'), {}, {
    builder: {
        basic: false,
        advanced: false,
        data: false,
        customBasic: {
            title: 'Basic Components',
            default: true,
            weight: 0,
            components: {
                textfield: true,
                textarea: true,
                email: true,
                phoneNumber: true
            }
        },
        layout: {
            components: {
                table: false
            }
        }
    },
    editForm: {
        textfield: [{
            key: 'api',
            ignore: true
        }]
    }
}).then(function(builder) {
    const submitButton = document.getElementById('submitButton');
    // Define alertMessage here
    const alertMessage = document.getElementById('alertMessage');
    submitButton.addEventListener('click', function() {

        // Get the form name value
        const formName = document.getElementById('name').value;
        const formData = builder.schema;
        // Add the form name to the formData object
        formData.formName = formName;
        const csrfToken = '{{ csrf_token() }}';
        formData._token = csrfToken;
        console.log(formData);
        // Send an AJAX request
        fetch('/submit/form', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
                if (data.message === 'Form Created Successfully') {
                // Display a Bootstrap alert message
                alertMessage.classList.add('alert-success');
                alertMessage.innerHTML = 'Form Created Successfully!';
                alertMessage.style.display = 'block';
            }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
</script>
@endsection