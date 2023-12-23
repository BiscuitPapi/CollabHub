function getSkillSuggestions(query) {
    var myHeaders = new Headers();
    myHeaders.append("apikey", "IJpkr8AuQOjoYmJykoWNZuP0P2GwqQWA");

    var requestOptions = {
        method: 'GET',
        redirect: 'follow',
        headers: myHeaders
    };

    fetch(`https://api.apilayer.com/skills?q=${query}`, requestOptions)
        .then(response => response.json())
        .then(data => {
            console.log('Received data:', data);

            // Update suggestions dropdown dynamically
            updateSuggestionsDropdown(data);
        })
        .catch(error => console.log('Error:', error));
}

function updateSuggestionsDropdown(data) {
    var suggestionsContainer = document.getElementById('suggestions-container');

    if (data && data.skills && data.skills.length > 0) {
        var dropdown = document.createElement('ul');
        dropdown.className = 'autocomplete-items';

        data.skills.forEach(skill => {
            var suggestionItem = document.createElement('li');
            suggestionItem.textContent = skill.name;
            suggestionItem.addEventListener('click', function () {
                document.getElementById('addedSkills').value = skill.name;
                suggestionsContainer.innerHTML = ''; // Clear suggestions after selection
            });

            dropdown.appendChild(suggestionItem);
        });

        suggestionsContainer.innerHTML = ''; // Clear previous suggestions
        suggestionsContainer.appendChild(dropdown);
    }
}
