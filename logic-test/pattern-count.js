// Silakan tulis kode yang mengandung setidaknya satu fungsi/metode utama
// yang disebut patternCount yang menerima dua string atau dua array karakter
// dengan panjang antara 0 dan 100 karakter. Pertama parameter adalah teks
// dan parameter kedua adalah pattern. Fungsi ini akan mengembalikan angka
// bagaimana banyak pola ada di dalam teks. Asumsikan parameter input selalu
// tidak nol. Solusi Anda tidak boleh menggunakan fungsi pembantu yang telah
// ditentukan sebelumnya seperti substr_count di PHP atau panjang
// kecocokan regex dalam JavaScript.

function patternCount(text, pattern) {
  let count = 0;
  let textLength = text.length;
  let patternLength = pattern.length;

  if (patternLength === 0 || textLength === 0) return 0;

  for (let i = 0; i <= textLength - patternLength; i++) {
    if (text.slice(i, i + patternLength) === pattern) {
      count++;
    }
  }

  return count;
}

console.log(patternCount("palindrom", "ind"));
console.log(patternCount("ababab", "aba"));
console.log(patternCount("abakadabra", "ab"));
console.log(patternCount("aaaaaa", "aa"));
console.log(patternCount("hello", ""));
console.log(patternCount("hell", "hello"));

console.log(patternCount("faqih", "qih"));
console.log(patternCount("faQih", "qih"));
