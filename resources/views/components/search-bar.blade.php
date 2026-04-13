<form action="/search">
    <label class="search-box" for="admin-search">
        <input
            id="admin-search"
            type="search"
            name="q"
            placeholder="Search"
        />
        <img
            src="{{ Vite::asset('resources/icons/Search.svg') }}"
            alt="Search"
            class="icon search-icon"
        />
        <button type="submit" hidden />
    </label>
</form>
