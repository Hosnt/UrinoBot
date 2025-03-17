	<div class="header" hidden>
			<div class="header__grid">
				<img class="header__logo" src="https://uploads-ssl.webflow.com/5f6bc60e665f54545a1e52a5/6143750f1177056d60fc52d9_roboflow_logomark_inference.png" alt="Roboflow Inference">
				<div hidden> 
					<label class="header__label" for="model">Model</label>
					<input value="urine-sediment-yolov8" class="input" type="text" id="model" />
				</div>
				<div hidden> 
					<label class="header__label" for="version">Version</label>
					<input value="1" class="input" type="number" id="version" />
				</div>
				<div hidden> 
					<label class="header__label" for="api_key">API Key</label>
					<input value="pERkwJySSLIyoAM3nvIY" class="input" type="text" id="api_key" />
				</div>
			</div>
		</div>
	  
	 
				<div class="col-12-s6-m4" id="method" hidden> 
					<label class="input__label">Upload Method</label>
					<div>
						<button data-value="upload" id="computerButton" class="bttn left fill active">Upload</button>
						<button data-value="url" id="urlButton" class="bttn right fill">URL</button>
					</div>
				</div>

				<div class="col-12-m8" id="fileSelectionContainer" hidden>
					<label class="input__label" for="file">Select File</label>
					<div class="flex">
						<input class="input input--left flex-1" type="text" id="fileName" disabled />							
						<button  class="bttn right active">Browse</button>
					</div>
					<input style="display: none;" type="file" id="file" />
				</div>

				<div class="col-12-m8" id="urlContainer" hidden> 
					<label class="input__label" for="file" >Enter Image URL</label>
					<div class="flex">
						<input hidden type="text" id="url" placeholder="https://path.to/your.jpg" class="input"/><br>
					</div>
				</div>
		
				<div class="col-12-m6" hidden> 
					<label class="input__label" for="classes">Filter Classes</label>
					<input type="text" id="classes" placeholder="Enter class names" class="input"/><br>
					<span class="text--small">Separate names with commas</span>
				</div>

				<div class="col-6-m3 relative" hidden> 
					<label class="input__label" for="confidence">Min Confidence</label>
					<div>
						<i class="fas fa-crown"></i>
						<span class="icon">%</span>
						<input type="number" id="confidence" value="50" max="100" accuracy="2" min="0" class="input input__icon"/> 
					</div>
				<div class="col-6-m3 relative" hidden> 
					<label class="input__label" for="overlap">Max Overlap</label>
					<div>
						<i class="fas fa-object-ungroup"></i>
						<span class="icon">%</span>
						<input type="number" id="overlap" value="50" max="100" accuracy="2" min="0" class="input input__icon"/> 
				</div>
				<div class="col-6-m3" id="format" hidden> 
					<label class="input__label">Inference Result</label>
					<div>
						<button id="imageButton" data-value="image" class="bttn left fill active">Image</button>
						<button id="jsonButton" data-value="json" class="bttn right fill">JSON</button>
					</div>
				</div>
				<div class="col-12 content__grid" id="imageOptions" hidden> 
					<div class="col-12-s6-m4" id="labels">
						<label class="input__label">Labels</label>
						<div>
							<button class="bttn left active">Off</button>
							<button data-value="on" class="bttn right">On</button>
						</div>
					</div>
					<div class="col-12-s6-m4" id="stroke">
						<label class="input__label">Stroke Width</label>
						<div>
							<button data-value="1" class="bttn left active">1px</button>
							<button data-value="2" class="bttn">2px</button>
							<button data-value="5" class="bttn">5px</button>
							<button data-value="10" class="bttn right">10px</button>
						</div>
					</div>
				</div>
			
			</div>