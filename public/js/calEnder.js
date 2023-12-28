// To Get the Day Name
function getDayName(dateString, locale) {
  let date = new Date(dateString);
  return date.toLocaledateStringing(locale, { weekday: "short" });
}
let dateString = "2023-12-27";
let day = getDayName(dateString, "en-UK");
// let day = getDayName(dateString, "ar-EG");
console.log(day);
// ===========================

// This is a Function To Get All Month Days 
function getMonthDays(monthNumber) {}
