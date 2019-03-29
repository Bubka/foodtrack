<!-- Initialize typeahead.js on the input -->
<script>
    $(document).ready(function() {
        var bloodhound = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '/suggest/food?q=%QUERY%',
                wildcard: '%QUERY%'
            },
        });

        $('#food').typeahead({
            hint: true,
            highlight: true,
            minLength: 2
        }, {
            // this is append to form the class name of the suggestion menu
            name: 'foodSuggestions',
            limit: 30,
            source: bloodhound,
            display: function(data) {
                return data.name  //Input value to be set when you select a suggestion.
            },
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function(data) {
                    return '<div style="font-weight:normal; " class="list-group-item">'
                                + data.name + '<span class="small text-secondary" style="margin-left:5px">' + data.kcal + ' : ' + data.protein + ' / '
                                + data.carb + ' / ' + data.lipid + '</span></div></div>'
                }
            }
        }).on('typeahead:selected', function(ev, suggestion) {
            console.log(suggestion);
            $('#suggestedId').val(suggestion.id);
        });


        var bloodhoundForRecipe = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '/suggest/recipe?q=%QUERY%',
                wildcard: '%QUERY%'
            },
        });

        $('#recipe').typeahead({
            hint: true,
            highlight: true,
            minLength: 2
        }, {
            // this is append to form the class name of the suggestion menu
            name: 'recipeSuggestions',
            limit: 30,
            source: bloodhoundForRecipe,
            display: function(data) {
                return data.name  //Input value to be set when you select a suggestion.
            },
            templates: {
                empty: [
                    '<div class="list-group search-results-dropdown"><div class="list-group-item">Nothing found.</div></div>'
                ],
                header: [
                    '<div class="list-group search-results-dropdown">'
                ],
                suggestion: function(data) {
                    return '<div style="font-weight:normal; margin-top:-10px ! important;" class="list-group-item">'
                                + data.name + '<span class="small text-secondary" style="margin-left:5px">' + data.kcal + ' : ' + data.protein + ' / '
                                + data.carb + ' / ' + data.lipid + '</span></div></div>'
                }
            }
        }).on('typeahead:selected', function(ev, suggestion) {
            console.log(suggestion);
            $('#recipeSuggestedId').val(suggestion.id);
        });

    });
</script>