 <div class="row">
        <div class="col-md-12">
            <div class="header">
               <form class="navbar-form navbar-left">
                  <div class="form-group">
                    
                    <label for="category">Category: </label> 
                       <form action="index.php" method="get">
                        <select name="category" id="category" class="form-control"
                                data-selected="<?php echo @$_GET['category']; ?>">
                            <option value="">All</option>
                           <!--  <option value="non-music">Non Music</option> -->
                           <!--  <option value="32">Action/Adventure</option> -->
                           <!--  <option value="31">Anime/Animation</option> -->
                            <option value="2">Autos & Vehicles</option>
                            <option value="23">Comedy</option>
                            <!-- <option value="33">Classics</option>
                            <option value="34">Comedy</option>
                            <option value="36">Drama</option>
                            <option value="35">Documentary</option> -->
                            <option value="27">Education</option>
                            <option value="24">Entertainment</option>
                           <!--  <option value="37">Family</option> -->
                            <option value="1">Film & Animation</option>
                           <!--  <option value="38">Foreign</option> -->
                            <option value="20">Gaming</option>
                          <!--   <option value="39">Horror</option> -->
                            <option value="26">Howto & Style</option>
                            <option value="30">Movies</option>
                            <option value="10">Music</option>
                            <option value="25">News & Politics</option>
                            <option value="29">Nonprofits & Activism</option>
                            <option value="15">Pets & Animals</option>
                            <option value="22">People & Blogs</option>
                            <!-- <option value="40">SciFi & Fantasy</option> -->
                            <option value="28">Science & Technology</option>
                            <!-- <option value="18">Short Movies</option>
                            <option value="42">Shorts</option> -->
                            <option value="43">Shows</option>
                            <option value="17">Sports</option>
                            <option value="44">Trailers</option>
                            <option value="19">Travel & Events</option>
                           <!--  <option value="41">Thriller</option>
                            <option value="21">Videoblogging</option> -->
                        </select>

                        <label for='txtFromDate'>Publish Date:</label>
                        <input type='text' name='txtFromDate' id='txtFromDate' class="form-control" value='<?php echo htmlspecialchars( getPublishAfterDate("Y-m-d"), ENT_QUOTES ) ; ?>' />
                        
                        <label for='txtToDate'>To:</label>
                        <input type='text' name='txtToDate' id='txtToDate' class="form-control" value='<?php echo htmlspecialchars( getPublishBeforeDate("Y-m-d"), ENT_QUOTES); ?>' />

                        <button type='submit' class="btn btn-primary">Search</button>
                        
                      </div>  
                </form>
     
            </div>  <!--header-->
           
           </div><!--col-md-12-->
    </div><!--row-->