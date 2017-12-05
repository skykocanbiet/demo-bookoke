<style>
li {
	list-style: none;
}
.btn {

}
.btn-group-justified {
    display: table;
    width: 100%;
    table-layout: fixed;
    border-collapse: separate;
}
.btn:hover, .btn:focus, .btn:active, .btn.active, .open>.dropdown-toggle.btn {
    color: #333;
    background-color: #e6e6e6;
    border-color: #adadad;
}
.btn-padded {
    color: #333;
    background-color: #fff;
    border-color: #ccc;
}
.btn-group, .btn-group-vertical {
    position: relative;
    display: inline-block;
    vertical-align: middle;
}
.btn-group-justified {
    display: table;
    width: 100%;
    table-layout: fixed;
    border-collapse: separate;
}
.btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle) {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.btn-group>.btn:first-child {
    margin-left: 0;
}
.btn-group>.btn:hover, .btn-group-vertical>.btn:hover, .btn-group>.btn:focus, .btn-group-vertical>.btn:focus, .btn-group>.btn:active, .btn-group-vertical>.btn:active, .btn-group>.btn.active, .btn-group-vertical>.btn.active {
    z-index: 2;
}
.btn-group-justified>.btn, .btn-group-justified>.btn-group {
    float: none;
    display: table-cell;
    width: 1%;
}
.btn-group>.btn, .btn-group-vertical>.btn {
    position: relative;
    float: left;
}
.btn-group-justified>.btn, .btn-group-justified>.btn-group {
    float: none;
    display: table-cell;
    width: 1%;
}
.btn:active, .btn.active, .open>.dropdown-toggle.btn {
    background-image: none;
}
.btn:active, .btn.active {
    outline: 0;
    background-image: none;
    box-shadow: inset 0 3px 5px rgba(0,0,0,.125);
}
.btn-padded {
    padding-left: 53px;
    padding-right: 53px;
}

.clearfix,.rg-row,.container,.form-horizontal .form-group,.form-horizontal .tight-grid .form-group,.form-horizontal .address .form-group,.inline-blocker-row,.btn-toolbar,.btn-group-vertical>.btn-group {
  *zoom: 1;
}
.clearfix:before,.clearfix:after,.rg-row:before,.rg-row:after,.container:before,.container:after,.form-horizontal .form-group:before,.form-horizontal .form-group:after,.form-horizontal .tight-grid .form-group:before,.form-horizontal .tight-grid .form-group:after,.form-horizontal .address .form-group:before,.form-horizontal .address .form-group:after,.inline-blocker-row:before,.inline-blocker-row:after,.btn-toolbar:before,.btn-toolbar:after,.btn-group-vertical>.btn-group:before,.btn-group-vertical>.btn-group:after {
  display: table;
  content: "";
  line-height: 0;
}
.clearfix:after,.rg-row:after,.container:after,.form-horizontal .form-group:after,.form-horizontal .tight-grid .form-group:after,.form-horizontal .address .form-group:after,.inline-blocker-row:after,.btn-toolbar:after,.btn-group-vertical>.btn-group:after {
  clear: both;
}
.day-group {
  margin-bottom: 20px;
  border-bottom: 1px solid #efefef;
  padding-bottom: 10px;
}

.day-group:last-of-type {
  border-bottom: none;
}

.staff-location-modal .day-group {
  margin-bottom: 10px;
  border-bottom: 1px solid #efefef;
  padding-bottom: 5px;
}
.staff-location-modal .day-group:last-of-type {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}
.inline-blocker {
  display: inline-block;
  margin-right: 10px;
  float: left;
  min-height: 34px;
  line-height: 34px;
  height: 34px;
  margin-bottom: 10px;
}

.inline-blocker.inline-blocker--right {
  margin-right: 0;
  float: right;
}
.inline-blocker--fixed {
  width: 150px;
}
.inline-blocker-row--double .inline-blocker {
  height: 68px;
}
.reports .sub-nav-has-labels .inline-blocker {
  line-height: 24px;
}
.big-check {
  position: relative;
  display: inline-block;
  padding-right: 3rem;
  color: #555;
  cursor: pointer;
  font-weight: normal;
  font-size: 19px;
  line-height: 34px;
  margin-top: 0;
  margin-bottom: 0;
}

.big-check input {
  position: absolute;
  opacity: 0;
  z-index: -1;
}
.big-check input:checked~.big-check-indicator {
  color: #fff;
  background-color: #00b2ef;
}

.big-check input:active~.big-check-indicator {
  color: #fff;
  background-color: #84c6ff;
}
.big-check--left {
  padding-right: 2rem;
  margin-right: .5rem;
}
.modal-body .form-inline .checkbox {
  margin-top: 6px;
}
.customer-concession-table-calendar th input[type=checkbox],.customer-concession-table-calendar td input[type=checkbox] {
  margin-left: 40px;
}
.big-check-indicator {
  position: absolute;
  top: 0;
  right: 0;
  display: block;
  width: 34px;
  height: 34px;
  line-height: 34px;
  font-size: 65%;
  color: #ddd;
  border-radius: 50%;
  text-align: center;
  background-color: #ddd;
  background-size: 50% 50%;
  background-position: center center;
  background-repeat: no-repeat;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.big-check input:checked~.big-check-indicator {
  color: #fff;
  background-color: #00b2ef;
}

.big-check input:active~.big-check-indicator {
  color: #fff;
  background-color: #84c6ff;
}

.checkbox .big-check-indicator {
  margin-top: -2px;
  border-radius: 50%;
}

.checkbox input:checked~.big-check-indicator {
  background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4NCjwhLS0gR2VuZXJhdG9yOiBBZG9iZSBJbGx1c3RyYXRvciAxNy4xLjAsIFNWRyBFeHBvcnQgUGx1Zy1JbiAuIFNWRyBWZXJzaW9uOiA2LjAwIEJ1aWxkIDApICAtLT4NCjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+DQo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkxheWVyXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4Ig0KCSB2aWV3Qm94PSIwIDAgOCA4IiBlbmFibGUtYmFja2dyb3VuZD0ibmV3IDAgMCA4IDgiIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KPHBhdGggZmlsbD0iI0ZGRkZGRiIgZD0iTTYuNCwxTDUuNywxLjdMMi45LDQuNUwyLjEsMy43TDEuNCwzTDAsNC40bDAuNywwLjdsMS41LDEuNWwwLjcsMC43bDAuNy0wLjdsMy41LTMuNWwwLjctMC43TDYuNCwxTDYuNCwxeiINCgkvPg0KPC9zdmc+DQo=);
}

label {
    display: inline-block;
    max-width: 100%;
    margin-bottom: 5px;
    font-weight: bold;
}
label {
    cursor: default;
}
.radio, .checkbox {
    min-height: 20px;
}
/*CHANGE*/
.drop-container{
	padding: 0px;
}
/*END CHANGE*/
.has-error .validation-error, .error .validation-error {
    display: block;
}
.has-error .help-block, .error .help-block, .has-error .control-label, .error .control-label, .has-error .radio, .error .radio, .has-error .checkbox, .error .checkbox, .has-error .radio-inline, .error .radio-inline, .has-error .checkbox-inline, .error .checkbox-inline {
    color: #c72f29;
}
.parsley-required{
	 color: #c72f29;
}
</style>