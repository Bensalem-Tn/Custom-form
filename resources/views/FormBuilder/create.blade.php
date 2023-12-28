@extends('layouts.app')
@section('head')
    <title>Example formBuilder</title>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <label for="name">Name :</label>
                    <input type="text" id="name" name="name" class="form-control" />
                </div>
                <div class="col-md-3">
                    <label for="caption">Caption : </label>
                    <input type="text" id="caption" name="caption" class="form-control" />
                </div>
                <div class="col-md-2">
                    <label for="type">Type : </label>
                    <select id="type" name="type" class="form-control">
                        <option value="Event">Event</option>
                        <option value="Activity">Activity</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="position">Position : </label>
                    <select id="position" name="position" class="form-control">
                        <option value="in-port">In Port</option>
                        <option value="in-filed">In Field</option>
                        <option value="in-transit">In Transit</option>
                    </select>
                    <input type="text" id="position" name="position" class="form-control" />
                </div>
                <div class="col-md-2">
                    <label for="assetType">Asset Type :</label>
                    <select id="assetType" name="assetType[]" class="form-control" multiple>
                        <option value="1">Asset type  1</option>
                        <option value="2">Asset type  2</option>
                        <option value="3">Asset type  3</option>
                        <option value="4">Asset type  4</option>
                        <option value="5">Asset type  5</option>
                        <option value="6">Asset type  6</option>
                       
                       
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="rob">ROB :</label>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="robYes" name="rob" class="form-check-input" value="1">
                        <label class="form-check-label" for="robYes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" id="robNo" name="rob" class="form-check-input" value="0">
                        <label class="form-check-label" for="robNo">No</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="fb-editor">Editor</label>
                    <div id="fb-editor"></div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
    <script src="{{ URL::asset('assets/form-builder/form-builder.min.js') }}"></script>
    <script>
        jQuery(function($) {


            var isDragging = false;

$('fb-editor').formBuilder({
    onAddField: function () {
        // Disable dragging when a field is added
        $('.fb-field-wrapper').attr('draggable', 'false');
    },
    onStart: function (event, ui) {
        // Set isDragging to true when a field is dragged
        isDragging = true;
    },
    onStop: function (event, ui) {
        // Set isDragging to false when the drag stops
        isDragging = false;
    },
    onDrag: function (event, ui) {
        // Cancel the drag if isDragging is already true
        if (isDragging) {
            return false;
        }
    }
});
            $(document.getElementById('fb-editor')).formBuilder({
                onSave: function(evt, formData) {
                    console.log(formData);
                    saveForm(formData);
                },
            });
        });

        function saveForm(form) {
            $.ajax({
                type: 'post',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('token')
                },
                url: '{{ URL('save-form-builder') }}',
                data: {
                    'form': form,
                    'name': $("#name").val(),
                    'caption': $("#caption").val(),
                    'type': $("#type").val(),
                    'position': $("#position").val(),
                    'assetType': $("#assetType").val(),
                    'rob':  $("input[name='rob']:checked").val(),
                    "_token": "{{ csrf_token() }}",
                },
                success: function(data) {
                    location.href = "/form-builder";
                    console.log(data);
                }
            });
        }
    </script>
@endsection
