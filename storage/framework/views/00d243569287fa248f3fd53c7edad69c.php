<?php echo $__env->make('frontend.layout.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <style>
     body {
         font-family: "Irish Grover", serif;
         font-weight: 400;
         font-style: normal;
         background-image: url(assets/img/peroson.jpg);
     }

     @media (max-width: 480px) {
         h1.map-title.person-heading {
             top: 32% !important;
             left: 5px;
             width: 90%;
         }
     }


     .main-container{
        position: relative;
        width: 100vw;
        height: 65vh;

     }
     .icon {
         position: relative;
         /* Make sure the image is positioned relative */
     }

     .map-text {
         display: none;
         position: absolute;
         top: -50px;
         left: 5%;
         transform: translateX(-50%);
         color: #fff;
         z-index: 9999;
         background-color: #2d6a30;
         color: white;

         font-size: 22px;
         text-transform: uppercase;
         letter-spacing: 0.1em;
         padding: 7px 21px;
         border-radius: 12px;
         border: none;
         cursor: pointer;
         transition: transform 0.3s ease;
         text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
     }

     .icon:hover+.map-text {
         display: block;
     }

     span.map-text.Radio-text {
         left: 15%;
     }

     span.map-text.music {
         left: 26%;
     }

     span.map-text.feed {
         left: 36%;
     }

     span.map-text.cameras {
         left: 46%;
     }

     span.map-text.Room {
         left: 57%;
     }

     span.map-text.Friends {
         left: 67%;
     }

     span.map-text.name {
         left: 77%;
     }

     span.map-text.setting {
         left: 87%;
     }

     span.map-text.fam {
         left: 96%;
     }

     .btn-primary {
    background-color: #007bff;
    color: white;
    padding: 10px 10px;
    border-radius: 5px;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}

.btn-primary:hover {
    background-color: #0056b3;
    color: #fff;
}
 </style>

     <div class="main-container">

<div class="map-background">
<h1 class="map-title person-heading" style="text-align: left;">

    <div>
        <strong>Workplace:</strong>
        <span class="editable" id="workplace" data-field="workplace"><?php echo e($user->workplace ?? 'N/A'); ?></span>
    </div>

    <div>
        <strong>School:</strong>
        <span class="editable" id="school" data-field="school"><?php echo e($user->school ?? 'N/A'); ?></span>
    </div>

    <div>
        <strong>Pensacola:</strong>
        <span class="editable" id="pensacola" data-field="Pensacola"><?php echo e($user->Pensacola ?? 'N/A'); ?></span>
    </div>

    <div>
        <strong>Date of Birth:</strong>
        <span class="editable" id="dob" data-field="dob"><?php echo e($user->dob ? \Carbon\Carbon::parse($user->dob)->format('d M, Y') : 'N/A'); ?></span>
    </div>

    <div>
        <strong>Loves:</strong>
        <span class="editable" id="loves" data-field="loves"><?php echo e($user->loves ?? 'N/A'); ?></span>
    </div>

    <div>
        <strong>Hometown:</strong>
        <span class="editable" id="home_town" data-field="home_town"><?php echo e($user->home_town ?? 'N/A'); ?></span>
    </div>

    <div>
        <strong>Current City:</strong>
        <span class="editable" id="current_city" data-field="current_city"><?php echo e($user->current_city ?? 'N/A'); ?></span>
    </div>

    <div>
        <strong>Favorite Song:</strong>
        <span class="editable" id="favorite_song" data-field="favorite_song"><?php echo e($user->favorite_song ?? 'N/A'); ?></span>
    </div>

    <div>
        <strong>Employer:</strong>
        <span class="editable" id="employer" data-field="employer"><?php echo e($user->employer ?? 'N/A'); ?></span>
    </div>

    <div>
        <strong>Job Title:</strong>
        <span class="editable" id="job_title" data-field="job_title"><?php echo e($user->job_title ?? 'N/A'); ?></span>
    </div>

    <div>
        <strong>Currently In:</strong>
        <span class="editable" id="current_city_display" data-field="current_city_display"><?php echo e($user->current_city ?? 'N/A'); ?></span>
    </div>

</h1>

</div>


         <div>
             <img src="assets/img/logo.png" alt="" onclick="navigateTo('<?php echo e(url('/')); ?>')"
                 style="position: absolute; z-index: 9999999999;">
         </div>

         <?php echo $__env->make('frontend.layout.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

         <script>
             function navigateTo(url) {
                 window.location.href = url; // Navigate to the provided URL
             }
         </script>
     </div>

     <script>
        document.querySelectorAll('.editable').forEach(element => {
    element.addEventListener('click', function() {
        const currentValue = this.textContent; // Get current value
        const field = this.getAttribute('data-field'); // Get the field to update
        const input = document.createElement('input'); // Create an input element
        input.type = 'text';
        input.value = currentValue;
        this.innerHTML = ''; // Clear the span
        this.appendChild(input); // Append input field

        // Focus the input field to start editing
        input.focus();

        // When the input field loses focus (blur event), update the value
        input.addEventListener('blur', function() {
            const newValue = input.value.trim(); // Get new value

            if (newValue !== currentValue) {
                // If the value has changed, send an AJAX request to update the field
                updateField(field, newValue);
            }

            // After the update, display the new value and return to span view
            const span = document.createElement('span');
            span.classList.add('editable');
            span.setAttribute('data-field', field);
            span.textContent = newValue || 'N/A'; // Default to 'N/A' if empty
            this.replaceWith(span); // Replace input with span
        });
    });
});

// AJAX function to update the data
function updateField(field, value) {
    const data = {
        field: field,
        value: value,
        _token: '<?php echo e(csrf_token()); ?>' // CSRF token for Laravel security
    };

    fetch('<?php echo e(route('update-person')); ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data), // Send data as JSON
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Field updated successfully');
        } else {
            alert('Error updating field');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

     </script>
    <?php echo $__env->make('frontend.layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php /**PATH E:\laragon\www\animation_social\animation_social_project\resources\views/frontend/person.blade.php ENDPATH**/ ?>