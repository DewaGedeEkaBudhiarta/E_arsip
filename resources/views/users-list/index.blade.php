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
        dropdown.addEventListener('change', function() {
            filterFiles(dropdown, dropdown.nextElementSibling.id);
        });
    });

    // Hide success and error messages after 5 seconds
    setTimeout(function() {
        let successMessage = document.querySelector('.bg-green-500');
        let errorMessage = document.querySelector('.bg-red-500');
        if (successMessage) {
            successMessage.style.display = 'none';
        }
        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 5000); // 5000 milliseconds = 5 seconds
});

function filterFiles(classificationDropdown, fileDropdownId) {
    const classification = classificationDropdown.value;
    const fileDropdown = document.getElementById(fileDropdownId);
    const options = fileDropdown.querySelectorAll('option');
    let hasVisibleOption = false;

    options.forEach(option => {
        if (option.getAttribute('data-classification') === classification) {
            option.style.display = 'block';
            if (!hasVisibleOption) {
                option.selected = true;
                hasVisibleOption = true;
            }
        } else {
            option.style.display = 'none';
            option.selected = false;
        }
    });

    // If no options are visible, clear the selection
    if (!hasVisibleOption) {
        fileDropdown.selectedIndex = -1;
    }

    // Update hidden inputs in forms
    const forms = classificationDropdown.parentElement.querySelectorAll('form');
    forms.forEach(form => {
        form.querySelector('input[name="classification"]').value = classification;
        form.querySelector('input[name="file_id"]').value = fileDropdown.value;
    });

    // Debugging: Log the updated hidden inputs
    console.log('Updated hidden inputs:', {
        classification: classification,
        file_id: fileDropdown.value
    });
}

function updateHiddenInputs(form) {
    const classificationDropdown = form.parentElement.querySelector('.classification-dropdown');
    const fileDropdown = form.parentElement.querySelector('.file-dropdown');
    form.querySelector('input[name="classification"]').value = classificationDropdown.value;
    form.querySelector('input[name="file_id"]').value = fileDropdown.value;

    // Debugging: Log the form data before submission
    console.log('Form data before submission:', {
        classification: form.querySelector('input[name="classification"]').value,
        file_id: form.querySelector('input[name="file_id"]').value
    });
}

</script>
@endsection