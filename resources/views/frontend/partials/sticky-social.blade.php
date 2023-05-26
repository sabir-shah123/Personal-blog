<style>
    /*Right Side Buttons Start*/
    .sticky-container {
        padding: 0px;
        margin: 0px;
        position: fixed;
        right: -119px;
        top: 130px;
        width: 200px;
    }

    .sticky li {
        list-style-type: none;
        background-color: #333;
        color: #efefef;
        height: 43px;
        padding: 0px;
        margin: 0px 0px 1px 0px;
        -webkit-transition: all 0.25s ease-in-out;
        -moz-transition: all 0.25s ease-in-out;
        -o-transition: all 0.25s ease-in-out;
        transition: all 0.25s ease-in-out;
        cursor: pointer;
        filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0.3333 0.3333 0.3333 0 0 0 0 0 1 0\'/></filter></svg>#grayscale");
        filter: gray;
        -webkit-filter: grayscale(100%);
    }

    .sticky li:hover {
        margin-left: -115px;
        filter: url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\'><filter id=\'grayscale\'><feColorMatrix type=\'matrix\' values=\'1 0 0 0 0, 0 1 0 0 0, 0 0 1 0 0, 0 0 0 1 0\'/></filter></svg>#grayscale");
        -webkit-filter: grayscale(0%);
    }

    .sticky li img {
        float: left;
        margin: 5px 5px;
        margin-right: 10px;
    }

    .sticky li p {
        float: left;
        padding: 0px;
        margin: 0px;
        text-transform: uppercase;
        line-height: 43px;

    }

    /*Right Side Buttons End*/

    /*Left Side Buttons Start*/
    .sticky-left-container {
        padding: 0px;
        margin: 0px;
        position: fixed;
        left: -158px;
        top: 40%;
        width: 200px;
        z-index: 2;
    }

    .sticky-left li {
        list-style-type: none;
        background-color: none;
        color: #efefef;
        height: 43px;
        padding: 0px;
        margin: 0px 0px 1px 0px;
        -webkit-transition: all 0.25s ease-in-out;
        -moz-transition: all 0.25s ease-in-out;
        -o-transition: all 0.25s ease-in-out;
        transition: all 0.25s ease-in-out;
        cursor: pointer;
    }

    .sticky-left li:hover {
        margin-right: -150px;
        background: #333;
        border-radius: 25px 25px 25px 0;
    }

    .sticky-left li img {
        float: right;
        border-radius: 50%;
        margin: 5px 5px;
        margin-left: 10px;
    }

    .sticky-left li p {
        padding: 0px;
        float: right;
        margin: 0px;
        text-transform: uppercase;
        line-height: 43px;
        color: #efefef !important;
    }

    /*Left Side Buttons End*/
</style>

<div class="sticky-left-container">
    <ul class="sticky-left">
        <a href="{{ $settings->facebook ?? '#' }}" target="_blank">
            <li>
                <img width="32" height="32" title="" alt=""
                    src="https://img.icons8.com/ios-filled/50/319AE7/facebook-circled--v1.png">
                <p>Facebook</p>
            </li>
        </a>

        <a href="{{ $settings->twitter ?? '#' }}" target="_blank">
            <li>
                <img width="32" height="32" title="" alt=""
                    src="https://img.icons8.com/metro/26/F1551B/twitter.png">
                <p>Twitter</p>
            </li>
        </a>

        <a href="{{ $settings->linkedin ?? '#' }}" target="_blank">
            <li>
                <img width="32" height="32" title="" alt=""
                    src="https://img.icons8.com/material/24/7D8EF6/linkedin--v1.png">
                <p>LinkedIn</p>
            </li>
        </a>

        <a href="{{ $settings->youtube ?? '#' }}" target="_blank">
            <li>
                <img width="32" height="32" title="" alt=""
                    src="https://img.icons8.com/material/24/F34018/youtube-play--v1.png">
                <p>Youtube</p>
            </li>
        </a>

        <a href="{{ $settings->github ?? '#' }}" target="_blank">
            <li>
                <img width="32" height="32" title="" alt=""
                    src="https://img.icons8.com/material/24/000000/github.png">
                <p>Github</p>
            </li>
        </a>
    </ul>
</div>
