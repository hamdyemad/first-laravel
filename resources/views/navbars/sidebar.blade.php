<div class="side-nav active">
  <h5 class="text-center p-3">Project Name</h5>
  <div class="links">
    <ul>
      <li>
        <a>
          <div class="first">
            <div class="icon">
              <i class="fas fa-box"></i>
            </div>
            <span>Products</span>
          </div>
          <div class="chevron">
            <i class="fas fa-chevron-right"></i>
          </div>
        </a>
        <!-- Start Drop Down -->
        <ul class="drop-down">
          <li>
          <a class="{{ activeLink('products.showAll') }}" href="{{ route('products.showAll') }}">
              <div class="first">
                <div class="icon">
                  <i class="fas fa-eye"></i>
                </div>
                <span>Show</span>
              </div>
            </a>
          </li>
          <li>
            <a class="{{ activeLink('products.create') }}" href="{{ route('products.create') }}">
              <div class="first">
                <div class="icon">
                  <i class="far fa-plus-square"></i>
                </div>
                <span>Create</span>
              </div>
            </a>
          </li>
        </ul>
        <!-- End Drop Down -->

      </li>
      <li>
        <a>
          <div class="first">
            <div class="icon">
              <i class="fas fa-sliders-h"></i>
            </div>
            <span>Categories</span>
          </div>
          <div class="chevron">
            <i class="fas fa-chevron-right"></i>
          </div>
        </a>
        <!-- Start Drop Down -->
        <ul class="drop-down">
          <li>
            <a class="{{ activeLink('categories.create') }}" href="{{ route('categories.create') }}">
              <div class="first">
                <div class="icon">
                  <i class="far fa-plus-square"></i>
                </div>
                <span>Create</span>
              </div>
            </a>
          </li>
          <li>
            <a class="{{ activeLink('categories.showAll') }}" href="{{ route('categories.showAll') }}">
              <div class="first">
                <div class="icon">
                  <i class="far fa-eye"></i>
                </div>
                <span>Show</span>
              </div>
            </a>
          </li>
        </ul>
        <!-- End Drop Down -->

      </li>
      <li>
        <a>
          <div class="first">
            <div class="icon">
              <i class="fas fa-box"></i>
            </div>
            <span>Produts</span>
          </div>
        </a>
      </li>
    </ul>
  </div>
</div>

@section('script')
<script>

  // toggle sidebar
  let sideNav = $('.admin .side-nav'),
    last = $('.admin .last'),
  SideWidth = sideNav.width();
  $('.admin .geer').on('click', function() {
    sideNav.toggleClass('active');
    console.log(last);
    if(!sideNav.hasClass('active')) {
      last.css('padding-left', '0');
    } else {
      last.css('padding-left', SideWidth + 'px');

    }
  });

  // toggle drop down
  $('.admin .side-nav .links > ul li').each(function(index, link) {
      let dropDown = $(this).children()[1];
      if(dropDown !== undefined) {
        $(dropDown).children().each(function(index, dropDownLink) {
          if($(dropDownLink).find('a').hasClass('active')) {
            $(link).addClass('active');
            $(dropDown).slideDown();
            $(link).children().children().next('.chevron').toggleClass('active');
          }
        });
        $(link).on('click', function() {
            $(dropDown).slideToggle();
            $(link).children().children().next('.chevron').toggleClass('active');
        })
      }
  });

</script>
@endsection
