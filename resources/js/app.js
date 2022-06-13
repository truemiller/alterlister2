/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// require('./components/Example');

// Star hovering
// $('.fa-star,.fa-star-half-alt').hover(
//     function(){ $(this).addClass('text-muted') },
//     function(){ $(this).removeClass('text-muted') }
// );

// Blood hound typeahead

// get data
const entities = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('title'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
        url: '/api/search/%QUERY',
        wildcard: '%QUERY'
    }
});
// make dropdown work
$('#search').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'my-dataset',
        source: entities,
        display: 'title'
    });
// bind selected event
$('#search').bind('typeahead:selected', function($obj, $datum, $name){
    location.href="/"+($datum['slug']);
});

