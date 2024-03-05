rootProject.name = "tp4_API_REST"
include("src:models")
findProject(":src:models")?.name = "models"
include("services")
include("api")
