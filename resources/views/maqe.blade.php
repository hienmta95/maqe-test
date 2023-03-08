<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ Session::token() }}">

    <title>MAQE bot</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        .wrapper {
            margin: 0 auto;
            border: 1px solid #eee;
            border-radius: 5px;
            max-width: 800px;
            padding: 20px;
            margin-top: 100px;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
        }

        .input-wrapper .maqe-input {
            width: 400px;
            margin: 3px;
            padding-left: 19px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <form>
            <h5>MAQE bot ...</h5>
            <br />

            <div class="input-wrapper" id="wrap">
                <input type="text" name="maqe_text" placeholder="Enter code here.." class="maqe-input form-control" />
                <button class="btn btn-primary" id="btn-submit">Submit</button>
            </div>

            <br />
            <hr />

            <div class="input-group mb-3 mt-4">
                <span style="border-radius: 0;" class="input-group-text" id="inputGroup-sizing-default">Result: </span>
                <input style="max-width: 400px" id="result" type="text" class="form-control" />
            </div>

        </form>
    </div>

    <script>
        $(document).ready(function() {

            $('body').on('click', '#btn-submit', function(e) {
                e.preventDefault();
                $('#result').val('');

                const maqe_text = $("input[name=maqe_text]").val();

                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: document.URL + 'maqe',
                    type: 'POST',
                    data: {
                        maqe_text
                    },
                    success: function(response) {
                        $('#result').val(JSON.stringify(response.data));
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                        alert(textStatus + ': ' + jqXHR.responseJSON.message);
                    }
                });

            });

        });
    </script>
</body>

</html>