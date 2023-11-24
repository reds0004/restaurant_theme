document.addEventListener('DOMContentLoaded', function () {
    const menuContainer = document.querySelector('.menus nav');
    const sections = document.querySelectorAll('.menu-section');
    const buttons = menuContainer.querySelectorAll('.menu-button');

    if (!menuContainer) {
        console.error('Menu container not found');
        return;
    }

    // Initially set the first section and button as active
    if (sections.length > 0 && buttons.length > 0) {
        sections[0].classList.add('active');
        buttons[0].classList.add('active');
    }

    menuContainer.addEventListener('click', function (event) {
        if (event.target.classList.contains('menu-button')) {
            const targetId = event.target.getAttribute('data-target');
            const targetSection = document.getElementById(targetId);

            // Hide all sections and remove 'active' class from all buttons
            sections.forEach(section => {
                section.classList.remove('active');
            });
            buttons.forEach(button => {
                button.classList.remove('active');
            });

            // Show the clicked section and set the button as active
            if (targetSection) {
                targetSection.classList.add('active');
                event.target.classList.add('active');
            } else {
                console.error('No section found for target ID:', targetId);
            }
        }
    });
});
