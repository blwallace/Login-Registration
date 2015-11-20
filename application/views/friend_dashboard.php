<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <div class='content'>
                <h5>
<!-- // This section is used mainly to display errors during the registration process -->
              <?php 
        echo $this->session->flashdata('login_error');
        echo $this->session->flashdata('registration_error');
         ?>
         <div id="errors"></div>
      </h5>	

    <h3>Here is a list of your friends!</h3>

		<table class='table'>
			<tr>
				<th>Alias</th>
				<th>Action</th>
			</tr>

<?php
			foreach($friends as $friend)
			{?>
				<tr>
					<td><?= $friend['alias']?></td>
					<td><a href="/users/show/<?= $friend['friend_id'] ?>">View Profile</a> | <a href="/friends/remove/<?= $friend['friend_id'] ?>">Remove as Friend</a></td>
				</tr>
<?php		}?>		

		</table>

    <h3>Here is a list of your enemies!</h3>

		<table class='table'>
			<tr>
				<th>Alias</th>
				<th>Action</th>
			</tr>

<?php
			foreach($enemies as $enemy)
			{?>
				<tr>
					<td><a href="/users/show/<?= $enemy['id'] ?>"><?= $enemy['alias']?></a></td>
					<td><a href="/friends/add/<?= $enemy['id'] ?>"><button type ='button' class = 'btn btn-default'>Add as Friend</button></a></td>
				</tr>
<?php		}?>		

		</table>		
	</div>


    </div>
    <div class="col-md-3"></div>
  </div>

</body>
</html>      
