// Select all elements with ID showSubitem
const showSubitems = document.querySelectorAll("#showSubitem");

// Function to handle click outside the showSubitem area
function handleClickOutside(e) {
  // Check if the click is outside
  showSubitems.forEach((item) => {
    if (
      !item.contains(e.target) &&
      !item.previousElementSibling.contains(e.target)
    ) {
      item.previousElementSibling.classList.remove("showSubitem");
    }
  });
}

// Add event listeners to all showSubitems
showSubitems.forEach((item) => {
  item.addEventListener("click", function (e) {
    // remove the class from all items
    showSubitems.forEach((item) => {
      item.previousElementSibling.classList.remove("showSubitem");
    });

    item.previousElementSibling.classList.add("showSubitem");
    e.stopPropagation();
  });
});

// detect clicks outside
document.addEventListener("click", handleClickOutside);
