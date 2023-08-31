@extends('layouts.adminlayout');
@section('content')
<div id="builder"></div>
<button id="submitButton" class="btn btn-primary">Submit </button>
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
    submitButton.addEventListener('click', function() {

        const formData = builder.schema;
        const csrfToken = '{{ csrf_token() }}';
        formData._token = csrfToken;
        console.log(builder.schema);
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
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
</script>
@endsection