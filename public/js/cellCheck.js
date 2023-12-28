let dayCells = document.querySelectorAll(".inner_cell");
// let symbolObject = {
//   X: "target",
//   O: "onrandom",
//   F: "failed",
//   P: "planned",
//   N: "new",
//   _: "_",
// };

dayCells.forEach((eachCell) => {
  let currentSymbol = eachCell.dataset.currentSymbo;
  eachCell.addEventListener("click", function () {
    // Toggle through symbols
    switch (currentSymbol) {
      case "_":
        currentSymbol = "X"; // Clear the cell
        eachCell.style.backgroundColor = "white";
        eachCell.dataset.currentSymbol = currentSymbol;
        break;
      case "X":
        currentSymbol = "O"; // Clear the cell
        eachCell.style.backgroundColor = "Orange";
        eachCell.dataset.currentSymbol = currentSymbol;
        break;
      case "O":
        currentSymbol = "F"; // Change to "F" on the next click
        eachCell.style.backgroundColor = "red";
        eachCell.dataset.currentSymbol = currentSymbol;
        break;
      case "F":
        currentSymbol = "P"; // Change to "P" on the next click
        eachCell.style.backgroundColor = "green";
        eachCell.dataset.currentSymbol = currentSymbol;
        break;
      case "P":
        currentSymbol = "N"; // Change to "N" on the next click
        eachCell.style.backgroundColor = "blue";
        eachCell.dataset.currentSymbol = currentSymbol;
        break;
      case "N":
        currentSymbol = "_"; // Change to "" (clear) on the next click
        eachCell.style.backgroundColor = "white";
        eachCell.dataset.currentSymbol = currentSymbol;
        break;
      default:
        break;
    }
    if (currentSymbol) {
      eachCell.innerText = currentSymbol;
    }
  });
});
