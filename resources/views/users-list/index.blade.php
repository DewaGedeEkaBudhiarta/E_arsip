@extends('layouts.app')

@section('title', 'user-list')

@section('content')
<div class="p-4 md:ml-64">
  @include('users-list.partials.user-list')
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const classificationDropdowns = document.querySelectorAll('.classification-dropdown');
    classificationDropdowns.forEach(dropdown => {
        filterFiles(dropdown, dropdown.nextElementSibling.id);
    });
});

function filterFiles(classificationDropdown, fileDropdownId) {
    const classification = classificationDropdown.value;
    const fileDropdown = document.getElementById(fileDropdownId);
    const options = fileDropdown.querySelectorAll('option');

    options.forEach(option => {
        if (option.getAttribute('data-classification') === classification) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });

    // Set the first visible option as selected
    const firstVisibleOption = fileDropdown.querySelector('option[style="display: block;"]');
    if (firstVisibleOption) {
        firstVisibleOption.selected = true;
    }

    // Update hidden inputs in forms
    const forms = classificationDropdown.parentElement.querySelectorAll('form');
    forms.forEach(form => {
        form.querySelector('input[name="classification"]').value = classification;
        form.querySelector('input[name="file_id"]').value = fileDropdown.value;
    });
}
</script>
@endsection