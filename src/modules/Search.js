import $ from "jquery"
class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.resultsDiv = document.querySelector("#search-results");
    this.searchField = document.querySelector("#search-term");
    this.searchField.value = '';
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
        this.typingTimer = setTimeout(this.getResults.bind(this), 750)
      } else {
        this.resultsDiv.innerHTML = "";
        this.isSpinnerVisible = false
      }
    }
    this.previousValue = this.searchField.value
    console.log(this.searchField.value);
  }

  getResults() {
    jQuery.ajax({
      type: "GET",
      url: 'http://localhost:10033/wp-json/PE_supportcenter/posts?term=' + this.searchField.value,
      data: '',
      datatype: "html",
      success: (results)=> {
        if(!results.length){
          this.resultsDiv.innerHTML =`
           <div>no results</div>`;
        }
        else{
          this.resultsDiv.innerHTML =`

            ${results.map(item => `<div><a class="scrollLink" href="./${item.modul.slug}#${item.slug}">${item.title} - ${item.modul.name}</a></div>`).join("")}
`;
          this.isSpinnerVisible = false;  
        }
        
        // let anchorlinks = document.querySelectorAll('.scrollLink')
        // for (let item of anchorlinks) { // relitere 
        //   item.addEventListener('click', (e)=> {
        //     let hashval = item.getAttribute('href')
        //     let target = document.querySelector(hashval)
        //     target.scrollIntoView({
        //       behavior: 'smooth',
        //       block: 'start'
        //     })
        //     history.pushState(null, null, hashval)
        //     e.preventDefault()
        //   })
        // }
      }
    });
  }


}

export default Search


