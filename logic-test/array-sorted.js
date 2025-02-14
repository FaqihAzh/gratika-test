// Urutkan array berikut [12, 9, 30, "A", "M", 99, 82, "J", "N", "B"] dengan urutan abjad
// di depan dan angka di belakang,
// contoh ["A", "B", "J", "M", "N", 9, 12, 30, 82, 99]

function sortArray(arr) {
  let letters = arr.filter((item) => typeof item === "string").sort();
  let numbers = arr
    .filter((item) => typeof item === "number")
    .sort((a, b) => a - b);

  return [...letters, ...numbers];
}

let array = [12, 9, 30, "A", "M", 99, 82, "J", "N", "B"];
let array_2 = [14, 0, 10, "F", "A", 2, 23, "Q", "I", "H"];

console.log("Sorted Result:", sortArray(array));
console.log("Sorted Result:", sortArray(array_2));
