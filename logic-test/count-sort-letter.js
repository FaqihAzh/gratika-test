// Buat fungsi yang menghitung banyak nya huruf yang user masukan dalam 1x
// inputan dan urutkan hasil akhir sesuai abjad, Perhatikan huruf kapital, jika
// terdapat abjad yang sama namun dalam kapital maka pisah huruf tersebut

function countSortLetter(strInput) {
  // Validasi INput
  if (typeof strInput !== "string") {
    return "Harus huruf";
  }

  if (!/[a-zA-Z]/.test(strInput)) {
    return "Isi string harus huruf";
  }

  let letterCount = [];

  for (let char of strInput) {
    if (/[a-zA-Z]/.test(char)) {
      let lowerChar = char.toLowerCase();
      if (!letterCount[lowerChar]) {
        letterCount[lowerChar] = { upper: 0, lower: 0 };
      }
      if (char === lowerChar) {
        letterCount[lowerChar].lower++;
      } else {
        letterCount[lowerChar].upper++;
      }
    }
  }

  let sortedLetters = Object.keys(letterCount).sort();

  let result = [];
  for (let letter of sortedLetters) {
    if (letterCount[letter].upper > 0) {
      // Huruf kapital lebih dahulu jika ada
      result[letter.toUpperCase()] = letterCount[letter].upper;
    }
    if (letterCount[letter].lower > 0) {
      result[letter] = letterCount[letter].lower;
    }
  }

  return result;
}

console.log(countSortLetter("Hello World"));
console.log(countSortLetter("Bismillah"));
console.log(countSortLetter("MasyaAllah"));

console.log(countSortLetter("Abang GaNteng"));

console.log(countSortLetter(123));
console.log(countSortLetter("123"));
