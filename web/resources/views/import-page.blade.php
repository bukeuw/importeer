@extends('layouts.main')

@section('content')

    <div class="row">
        <div class="col-4 offset-4">
            <div class="card mt-5">
                <div class="card-body">
                    <form id="uploadForm" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="control-label" for="xls">Upload File</label>
                            <input class="form-control" id="xls" type="file" name="xls">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Upload File</button>
                        </div>
                    </form>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody id="data-table"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('additional-js')
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.16.9/dist/shim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.16.9/dist/xlsx.full.min.js"></script>
    <script>
        (function () {
            function handleUpload (e) {
                e.preventDefault()
                var uploadElem = document.querySelector('#xls')
                var files = uploadElem.files
                var fileUpload = files[0]
                var reader = new FileReader()
                reader.onload = function (e) {
                    var data = new Uint8Array(e.target.result)
                    var workbook = XLSX.read(data, { type: 'array' })

                    var sheetName = workbook.SheetNames[0]
                    var sheet = workbook.Sheets[sheetName]
                    var jsonData = XLSX.utils.sheet_to_json(sheet)

                    console.log(jsonData)
                    var table = document.querySelector('#data-table')
                    jsonData.forEach(function (product) {
                        var productData = `
                           <tr>
                               <td>${product.name}</td>
                               <td>${product.description}</td>
                               <td>${product.price}</td>
                           </tr>
                        `
                        table.innerHTML += productData
                    })
                    uploadData(jsonData)
                }
                reader.readAsArrayBuffer(fileUpload)
            }
            document.querySelector('#uploadForm')
                    .addEventListener('submit', handleUpload, true);

            function uploadData (data) {
                var csrfToken = '{{ csrf_token() }}'
                fetch('/import-json', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        data,
                        _token: csrfToken
                    })
                }).catch(function (err) {
                    console.error(err)
                })
            }
        })()
    </script>
@endsection
