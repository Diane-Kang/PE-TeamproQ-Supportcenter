class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.resultsDiv = document.querySelector("#search-results");
    this.searchField = document.querySelector("#search-term");
    this.events()
    this.isSpinnerVisible = false
    this.previousValue
    this.typingTimer
  }

  // 2. events
  events() {
    this.searchField.addEventListener("keyup", this.typingLogic.bind(this));
  }

  // 3. methods (function, action...)
  typingLogic() {
    if (this.searchField.value != this.previousValue) {
      clearTimeout(this.typingTimer)
      if (this.searchField.value) {
        if (!this.isSpinnerVisible) {
          this.resultsDiv.innerHTML = '<div class="spinner-loader"></div>';
          this.isSpinnerVisible = true;
        }
        this.typingTimer = setTimeout(this.getResults.bind(this), 2000)
      } else {
        this.resultsDiv.innerHTML = "";
        this.isSpinnerVisible = false
      }
    }
    this.previousValue = this.searchField.value
    console.log(this.searchField.value);
  }

  getResults() {
    this.resultsDiv.html("Imagine real search results here...")
    this.isSpinnerVisible = false
  }

}

export default Search
