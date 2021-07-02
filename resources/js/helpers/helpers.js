// should have an image with hidden attribute and src = '' and it appended after file
export function selectInputFile(selectedBtn, inputFile) {
  let selectBtn = $(selectedBtn),
    file = $(inputFile);
  selectBtn.on('click', function () {
    $(file).click();
    $(file).on('change', function () {
      let fileName = this.files[0].name;
      selectBtn.text(fileName);
      let fileReader = new FileReader();
      fileReader.onload = function () {
        $(file).next('img').attr('src', this.result);
        $(file).next('img').removeAttr('hidden');
      }
      fileReader.readAsDataURL(this.files[0])
    })
  })
}
