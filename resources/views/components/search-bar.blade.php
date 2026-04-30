<form class="button-form" action="/search">
    <label class="search-box" for="search">
        <input
            id="search"
            type="search"
            name="q"
            placeholder="Search"
        />
        <img
            src="{{ Vite::asset('resources/icons/Search.svg') }}"
            alt="Search"
            class="icon search-icon"
        />
        <input type="submit" hidden/>
    </label>
</form>
