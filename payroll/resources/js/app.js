import './bootstrap';

import Alpine from 'alpinejs';

 const elements = document.querySelectorAll(".toggleSidebar");
  elements.forEach((element) => {
      element.addEventListener("click", function () {
         const sidebar = document.getElementById("sidebar");
         sidebar.classList.toggle("hidden");
      });
  });
const setup = () => {
  function getSidebarStateFromLocalStorage() {
    // if it already there, use it
    if (window.localStorage.getItem('isSidebarOpen')) {
      return JSON.parse(window.localStorage.getItem('isSidebarOpen'))
    }

    // else return the initial state you want
    return (
     false
    )
  }

  function setSidebarStateToLocalStorage(value) {
    window.localStorage.setItem('isSidebarOpen', value)
  }

return {
      loading: true,
      isSidebarOpen: getSidebarStateFromLocalStorage(),
      toggleSidbarMenu() {
        this.isSidebarOpen = !this.isSidebarOpen
        setSidebarStateToLocalStorage(this.isSidebarOpen)
      },
      isSettingsPanelOpen: false,
      isSearchBoxOpen: false,
  }
}
window.Alpine = Alpine;

Alpine.start();
