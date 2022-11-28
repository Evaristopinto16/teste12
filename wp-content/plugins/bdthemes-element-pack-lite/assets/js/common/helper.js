var debounce = function (func, wait, immediate) {
    // 'private' variable for instance
    // The returned function will be able to reference this due to closure.
    // Each call to the returned function will share this common timer.
    var timeout;

    // Calling debounce returns a new anonymous function
    return function () {
        // reference the context and args for the setTimeout function
        var context = this,
            args = arguments;

        // Should the function be called now? If immediate is true
        //   and not already in a timeout then the answer is: Yes
        var callNow = immediate && !timeout;

        // This is the basic debounce behaviour where you can call this
        //   function several times, but it will only execute once
        //   [before or after imposing a delay].
        //   Each time the returned function is called, the timer starts over.
        clearTimeout(timeout);

        // Set the new timeout
        timeout = setTimeout(function () {

            // Inside the timeout function, clear the timeout variable
            // which will let the next execution run when in 'immediate' mode
            timeout = null;

            // Check if the function already ran with the immediate flag
            if (!immediate) {
                // Call the original function with apply
                // apply lets you define the 'this' object as well as the arguments
                //    (both captured before setTimeout)
                func.apply(context, args);
            }
        }, wait);

        // Immediate mode and no wait timer? Execute the function..
        if (callNow) func.apply(context, args);
    };
};

/** 
 * Start used on Social Share
 */
function copyToClipboard(selector) {
    var $temp = jQuery("<div>");
    jQuery("body").append($temp);
    $temp.attr("contenteditable", true)
        .html(jQuery(selector).data('url')).select()
        .on("focus", function () {
            document.execCommand('selectAll', false, null);
        })
        .focus();
    document.execCommand("copy");
    $temp.remove();

    jQuery(selector).find('.bdt-social-share-title').html(jQuery(selector).data('copied'));
    setTimeout(() => {
        jQuery(selector).find('.bdt-social-share-title').html(jQuery(selector).data('orginal'));
    }, 5000);

}

jQuery('.bdt-ss-link').on('click', function () {
    copyToClipboard(this);
});

/** 
 * end Social Share
 */
