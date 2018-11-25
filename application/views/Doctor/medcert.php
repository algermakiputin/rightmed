<style>
  body {
  width: 700px;
  margin: 50px auto;
  }
  p {
  margin: 0;
  font-family: Bookman Old Style;
  }

  .btn {
  padding: 10px;
  width: 50px;
  display: inline-block;
  font-weight: 400;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  transition: all .15s ease-in-out;
  border-radius: 0;
  }

  .btn-info {
  color: #fff;
  background-color: #17a2b8;
  border-color: #17a2b8;
  }
</style>

<div style='text-align: center'>

<a href="#" id="print" class="btn btn-info" style="margin-top: -5px" onclick="window.print()">Print</a>

<br />
<p>Republic of the Philippines</p>
<p>Province of Kalinga</p>
<p style='font-weight: bold'>R.E.D. MEDICAL LABORATORY CLINIC</p>
<p>Liwan West, Rizal, Kalinga</p>
<p>Contact No. 09159126096</p>

<h1><p>MEDICAL CERTIFICATE</p></h1>
</div>

<br /><br />

<div style='float: right'>
    <p><?php echo date('F d, Y') ?></p>
</div>

<br /><br /><br />

<div>
    <p>To Whom It May Concern:</p>

    <br /><br />

    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This is to certify that 
    <b>
      <?php echo ucfirst($appointments[0]->patientfname) . ' ' . ucfirst($appointments[0]->patientmname) . ' ' . ucfirst($appointments[0]->patientlname) ?></b>
    was examined and treated at R.E.D Medical Laboratory Clinic on
    <?php echo $appointments[0]->date ?> with the following diagnosis:
    
    <br /><br />
    <p><b><?php echo $appointments[0]->findings ?>
 </b></p>

    <br /><br/></p>

    <p align='right'><?php echo ucfirst($appointments[0]->doctorfname) . ' ' . ucfirst($appointments[0]->doctorlname) ?>
    </p>
  <?php echo ucfirst ($person[0]->address)?>
</div>