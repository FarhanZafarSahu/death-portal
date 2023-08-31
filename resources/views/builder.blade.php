<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
    <!-- Include Formio CSS and JS libraries -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.form.io/js/formio.full.min.css">
    <script src="https://cdn.form.io/js/formio.full.min.js"></script>
</head>
<body>
<!-- Container for Formio Builder -->
<div id="builder"></div>
<button id="submitButton">Submit </button>
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
            custom: {
                title: 'User Fields',
                weight: 10,
                components: {
                    firstName: {
                        title: 'First Name',
                        key: 'firstName',
                        icon: 'terminal',
                        schema: {
                            label: 'First Name',
                            type: 'textfield',
                            key: 'firstName',
                            input: true
                        }
                    },
                    lastName: {
                        title: 'Last Name',
                        key: 'lastName',
                        icon: 'terminal',
                        schema: {
                            label: 'Last Name',
                            type: 'textfield',
                            key: 'lastName',
                            input: true
                        }
                    },
                    email: {
                        title: 'Email',
                        key: 'email',
                        icon: 'at',
                        schema: {
                            label: 'Email',
                            type: 'email',
                            key: 'email',
                            input: true
                        }
                    },
                    phoneNumber: {
                        title: 'Mobile Phone',
                        key: 'mobilePhone',
                        icon: 'phone-square',
                        schema: {
                            label: 'Mobile Phone',
                            type: 'phoneNumber',
                            key: 'mobilePhone',
                            input: true
                        }
                    }
                }
            },
            layout: {
                components: {
                    table: false
                }
            }
        },
        editForm: {
            textfield: [
                {
                    key: 'api',
                    ignore: true
                }
            ]
        }
    }).then(function(builder) {
        const submitButton = document.getElementById('submitButton');
        submitButton.addEventListener('click', function() {
            
            const formData = builder.schema;
            const csrfToken = '{{ csrf_token() }}';
            formData._token = csrfToken;
            console.log(builder.schema);
            // Send an AJAX request
            fetch('/submit-form', {
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
</body>
</html>