<!doctype html>
@php
$org = \AppHelper::instance()->orgProfile();
@endphp 
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Welcome Letter | {{$org['organization_name']}}</title>
    <style rel="stylesheet" type="text/css" media="print, screen">
        .text {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 25px;
            font-weight: bold;
            color: #000000;
            text-align: center;
            line-height: 47px;
            text-decoration: none;
        }

        .text1 {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: #333;
            text-align: justify;
            line-height: 23px;
            text-decoration: none;
        }

        .style1 {
            width: 100%;
            border: 1px solid gray;
            border-collapse: collapse;
        }

        .style1 td {
            border: 1px solid gray;

        }

        .style2 {
            font-weight: bold;
        }


        .bg {
            background: #fff;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;

        }

        .lineheight {
            line-height: 1.6em;
        }

        p {
            font-size: 15px;
        }
    </style>
    <script type="text/javascript">
        function PrintDivData(crtlid) {
            var ctrlcontent = document.getElementById(crtlid);
            var printscreen = window.open('', '', 'left=1,top=1,width=1,height=1,toolbar=0,scrollbars=0,status=0?');
            printscreen.document.write(ctrlcontent.innerHTML);
            printscreen.document.close();
            printscreen.focus();
            printscreen.print();
            printscreen.close();
        }

    </script>
</head>

<body leftmargin="0" topmargin="0" bgcolor="#FFFFFF" marginheight="0" marginwidth="0">
    <form method="post">

        <table id="Table1" align="center" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td align="center">

                        <input style="margin-top:20px;" id="Button1" name="Print" value="Print"
                            onclick="javascript:PrintDivData('printit');" type="button">
                    </td>
                </tr>
            </tbody>
        </table>
        <div id="printit" style="width:703px; text-align:center; margin:auto">

            <table id="Table_01" align="center" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <img src="{{asset('member/images/welcome/wel_01.png') }}" alt="">
                        <p style="margin-top:-80px; margin-left:-530px;">{{$org['organization_name']}}</p>
                        <p style="margin-top:-17px; margin-left:-470px;">Contact: {{$org['mobile']}}</p>
                        <p style="margin-top:-17px; margin-left:-420px;">Email: {{$org['email']}}</p>
                        <p style="margin-top:-18px; margin-left:-540px;">{!!$org['full_address']!!}</p>

                    </tr>
                    <tr>
                        <td>
                            <table id="Table_011" border="0" cellpadding="0" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td style="background-image:url(member/images/welcome/wel_1_01.png); background-repeat:repeat-y; "
                                            height="520" width="37">

                                            <!-- <img src="{{ asset('member/images/welcome/wel_1_01.png') }}" alt=""> -->

                                        </td>
                                        <td>
                                            <table id="Table_02" class="bg" border="0" cellpadding="0" cellspacing="0"
                                                width="630">
                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:22px;"> <b> CONGRATULATION ! </b></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="lineheight" align="left" width="630">
                                                            Join Date : <span id="lbldoj" style="font-weight:bold;">
                                                                {{ $client_acc-> join_date }}

                                                            </span>
                                                            <br>
                                                            <span id="lblName" style="font-weight:bold;">{{ $rsd-> m_name }}</span>
                                                            <br>
                                                            <span id="lblFather" style="font-weight:bold;">S/O / {{
                                                                $rsd->m_father_name }}</span> <br>
                                                            <span id="lblAddress" style="font-weight:bold;">{{
                                                                $rsd->m_address }},
                                                                {{ $rsd->m_city }},
                                                                {{ $rsd->m_state }}-{{ $rsd->m_pin }}</span> <br>
                                                            Mobile No. : <span id="lblMobile"
                                                                style="font-weight:bold;">{{ $rsd->m_mobile }}</span>
                                                            <br>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text1" height="243" width="630">
                                                            As New Family Member of , We would like to extend a warm and
                                                            healthy welcome to you at
                                                            <b> {{$org['organization_name']}} </b><br />
                                                            We wish you Good Luck and expecting a Long Term Relation
                                                            with you. We are delighted you have joined us! Your
                                                            contribution is important to ensure our sustained success
                                                            and growth. We hope that you would get maximum support from
                                                            the whole of our team and we look forward to having the best
                                                            relations with you.
                                                            <br><br>
                                                            We have a TEAM, a PLAN and a SYSTEM in place that
                                                            WORKS.<br><br>
                                                            For a better communication and perfect services, we request
                                                            you to keep writing us your valuable suggestions or
                                                            comments.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <table cellpadding="0" cellspacing="0" width="630">
                                                                <tbody>
                                                                    <tr class="text1">
                                                                        <td>
                                                                            <br>
                                                                            <table class="style1">
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>
                                                                                            Member Id</td>
                                                                                        
                                                                                        <td>
                                                                                            Sponsor Id</td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>
                                                                                            <span id="lblId"
                                                                                                style="font-weight:bold;">{{
                                                                                                $rsd->client_id }}
                                                                                            </span>
                                                                                        </td>

                                                                                        <td>
                                                                                            <span id="lblspid"
                                                                                                style="font-weight:bold;text-transform: uppercase;">{{
                                                                                                $client_acc->client_intro_id
                                                                                                }}
                                                                                            </span>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>

                                                                    <tr class="text1">
                                                                        <td style="font-style:italic; height:20px;"
                                                                            align="center">(This is computer gererated
                                                                            and does not require any
                                                                            singnatures.)</td>
                                                                    </tr>
                                                                    <tr class="text1">
                                                                        <td style="font-style:italic; height:20px;"
                                                                            class="style2" align="center">CUSTOMER
                                                                            CARE SUPPORT - {{$org['email']}} </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </td>
                                        <td style=" background-image:url(images/welcome_1_03.jpg); background-repeat:repeat-y; "
                                            height="520" width="36">
                                            <!-- <img src="{{ asset('member/images/welcome/wel_1_03.png') }}" alt=""> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td height="94">
                            <img src="{{ asset('member/images/welcome/wel_03.png') }}" alt="">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>

</body>

</html>