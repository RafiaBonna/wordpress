jQuery(document).ready(function($) {
    if (typeof FAQAccordionSettings === 'undefined') {
        console.warn('FAQAccordionSettings is not defined');
        return;
    }
    var accordionEvent = FAQAccordionSettings.accordionEvent;
    var accordionMode = FAQAccordionSettings.accordionMode;

    // Check the event type and bind events accordingly
    if (accordionEvent === '.mouseover') {
        // Hover event: Expand on mouse enter and collapse on mouse leave
        $('.accordion-button').each(function() {
            var button = $(this);

            button.on('mouseenter', function() {
                var targetId = button.attr('data-bs-target');
                var collapseElement = $(targetId);

                if (!collapseElement.hasClass('show')) {
                    new bootstrap.Collapse(collapseElement[0], {
                        toggle: true
                    });
                }
            });

            button.on('mouseleave', function() {
                var targetId = button.attr('data-bs-target');
                var collapseElement = $(targetId);

                if (collapseElement.hasClass('show')) {
                    new bootstrap.Collapse(collapseElement[0], {
                        toggle: true
                    });
                }
            });
        });
    } 

    // Accordion Mode handling
    if (accordionMode === '.first_open') {
        // Ensure only the first item is open by default
        var firstAccordionButton = $('.accordion-button').first();
        var firstCollapseElement = $(firstAccordionButton.attr('data-bs-target'));
    
        if (!firstCollapseElement.hasClass('show')) {
            new bootstrap.Collapse(firstCollapseElement[0], {
                toggle: true
            });
        }
    } else if (accordionMode === '.all_open') {
        // Open all accordions
        $('.accordion-button').each(function() {
            var targetId = $(this).attr('data-bs-target');
            var collapseElement = $(targetId);
    
            //  open the collapse
            if (!collapseElement.hasClass('show')) {
                new bootstrap.Collapse(collapseElement[0], {
                    toggle: true
                });
            }
        });
    
        // Explicitly trigger the opening of the first accordion if it's not opened yet
        var firstAccordionButton = $('.accordion-button').first();
        var firstCollapseElement = $(firstAccordionButton.attr('data-bs-target'));
    
        if (!firstCollapseElement.hasClass('show')) {
            new bootstrap.Collapse(firstCollapseElement[0], {
                toggle: true
            });
        }
    } else if (accordionMode === '.all_folded') {
        // Fold all accordions
        $('.accordion-button').each(function() {
            var targetId = $(this).attr('data-bs-target');
            var collapseElement = $(targetId);

            if (collapseElement.hasClass('show')) {
                new bootstrap.Collapse(collapseElement[0], {
                    toggle: true
                });
            }
        });
    }

});

function filterFAQs() {
    var input = document.querySelector('.faq-search-box');
    var filter = input.value.toLowerCase();
    var faqItems = document.querySelectorAll('.accordion-item');
    var noResultsMessage = document.querySelector('.no-results-message'); 

    var noMatchFound = true; // Flag to track if no items match

    faqItems.forEach(function(item) {
        var title = item.querySelector('.accordion-button').textContent.toLowerCase();
        
        if (title.includes(filter)) {
            item.style.display = '';
            noMatchFound = false; // Found a match, set to false
        } else {
            item.style.display = 'none';
        }
    });

    if (noMatchFound) {
        noResultsMessage.style.display = 'block'; 
    } else {
        noResultsMessage.style.display = 'none'; 
    }
}


